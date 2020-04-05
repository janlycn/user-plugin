<?php

namespace RainLab\User\Classes;

use October\Rain\Auth\Manager as RainAuthManager;
use RainLab\User\Models\Settings as UserSettings;
use RainLab\User\Models\UserGroup as UserGroupModel;
use Rainlab\User\Models\User as UserModel;

class AuthManager extends RainAuthManager
{
    protected static $instance;

    protected $sessionKey = 'user_auth';

    protected $userModel = 'RainLab\User\Models\User';

    protected $groupModel = 'RainLab\User\Models\UserGroup';

    protected $throttleModel = 'RainLab\User\Models\Throttle';

    public function init()
    {
        $this->useThrottle = UserSettings::get('use_throttle', $this->useThrottle);
        $this->requireActivation = UserSettings::get('require_activation', $this->requireActivation);
        parent::init();
    }

    /**
     * {@inheritDoc}
     */
    public function extendUserQuery($query)
    {
        $query->withTrashed();
    }

    /**
     * {@inheritDoc}
     */
    public function register(array $credentials, $activate = false, $autoLogin = true)
    {
        if ($guest = $this->findGuestUserByCredentials($credentials)) {
            return $this->convertGuestToUser($guest, $credentials, $activate);
        }

        return parent::register($credentials, $activate, $autoLogin);
    }

    //
    // Guest users
    //

    public function findGuestUserByCredentials(array $credentials)
    {
        if ($email = array_get($credentials, 'email')) {
            return $this->findGuestUser($email);
        }

        return null;
    }

    public function findGuestUser($email)
    {
        $query = $this->createUserModelQuery();

        return $user = $query
            ->where('email', $email)
            ->where('is_guest', 1)
            ->first();
    }

    /**
     * Registers a guest user by giving the required credentials.
     *
     * @param array $credentials
     * @return Models\User
     */
    public function registerGuest(array $credentials)
    {
        $user = $this->findGuestUserByCredentials($credentials);
        $newUser = false;

        if (!$user) {
            $user = $this->createUserModel();
            $newUser = true;
        }

        $user->fill($credentials);
        $user->is_guest = true;
        $user->save();

        // Add user to guest group
        if ($newUser && $group = UserGroupModel::getGuestGroup()) {
            $user->groups()->add($group);
        }

        // Prevents revalidation of the password field
        // on subsequent saves to this model object
        $user->password = null;

        return $this->user = $user;
    }

    /**
     * Converts a guest user to a registered user.
     *
     * @param Models\User $user
     * @param array $credentials
     * @param bool $activate
     * @return Models\User
     */
    public function convertGuestToUser($user, $credentials, $activate = false)
    {
        $user->fill($credentials);
        $user->convertToRegistered(false);

        // Remove user from guest group
        if ($group = UserGroupModel::getGuestGroup()) {
            $user->groups()->remove($group);
        }

        if ($activate) {
            $user->attemptActivation($user->getActivationCode());
        }

        // Prevents revalidation of the password field
        // on subsequent saves to this model object
        $user->password = null;

        return $this->user = $user;
    }

    /**
     * Finds a user by the login value.
     * 为支持多模式登录做了兼容
     *
     * @param string $login
     * @return mixed (Models\User || null)
     */
    public function findUserByLogin($login)
    {
        $model = $this->createUserModel();

        $query = $this->createUserModelQuery();

        $user = $query->where($model->getRealLoginName($login), $login)->first();

        return $this->validateUserModel($user) ? $user : null;
    }

    /**
     * Finds a user by the given credentials.
     * 为支持多模式登录做了兼容
     *
     * @param array $credentials The credentials to find a user by
     * @throws AuthException If the credentials are invalid
     * @return Models\User The requested user
     */
    public function findUserByCredentials(array $credentials)
    {
        $model = $this->createUserModel();
        $realLoginName = $this->getLoginNameByCredentials($credentials);

        if (!$realLoginName) {
            throw new AuthException(sprintf('缺少登录字段'));
        }

        $query = $this->createUserModelQuery();
        $hashableAttributes = $model->getHashableAttributes();
        $hashedCredentials = [];

        /*
         * Build query from given credentials
         */
        foreach ($credentials as $credential => $value) {
            // All excepted the hashed attributes
            if (in_array($credential, $hashableAttributes)) {
                $hashedCredentials = array_merge($hashedCredentials, [$credential => $value]);
            } else {
                $query = $query->where($credential, '=', $value);
            }
        }

        $user = $query->first();
        if (!$this->validateUserModel($user)) {
            throw new AuthException('A user was not found with the given credentials.');
        }

        /*
         * Check the hashed credentials match
         */
        foreach ($hashedCredentials as $credential => $value) {
            if (!$user->checkHashValue($credential, $value)) {
                // Incorrect password
                if ($credential == 'password') {
                    throw new AuthException(sprintf(
                        'A user was found to match all plain text credentials however hashed credential "%s" did not match.',
                        $credential
                    ));
                }

                // User not found
                throw new AuthException('A user was not found with the given credentials.');
            }
        }

        return $user;
    }

    /**
     * Validate a user's credentials, method used internally.
     * 为支持多模式登录做了兼容
     *
     * @param  array  $credentials
     * @return User
     */
    protected function validateInternal(array $credentials = [])
    {
        $realLoginName = $this->getLoginNameByCredentials($credentials);

        if (!$realLoginName) {
            throw new AuthException(sprintf('缺少登录字段'));
        }

        // if (empty($credentials['password'])) {
        //     throw new AuthException('The password attribute is required.');
        // }

        /*
         * If throttling is enabled, check they are not locked out first and foremost.
         */
        if ($this->useThrottle) {
            $throttle = $this->findThrottleByLogin($credentials[$realLoginName], $this->ipAddress);
            $throttle->check();
        }

        /*
         * Look up the user by authentication credentials.
         */
        try {
            $user = $this->findUserByCredentials($credentials);
        } catch (AuthException $ex) {
            if ($this->useThrottle) {
                $throttle->addLoginAttempt();
            }

            throw $ex;
        }

        if ($this->useThrottle) {
            $throttle->clearLoginAttempts();
        }

        return $user;
    }

    public function getLoginNameByCredentials(array &$credentials)
    {
        $loginModes = UserSettings::get('login_modes', ['username']);

        $model = $this->createUserModel();
        $multiLoginAttribute = UserModel::$multiLoginAttribute;

        if (
            $multiLoginAttribute &&
            array_key_exists($multiLoginAttribute, $credentials) &&
            !in_array($multiLoginAttribute, $loginModes)
        ) {
            $attribute = null;
            $loginValue = $credentials[$multiLoginAttribute];

            $attribute = $model->getRealLoginName($loginValue);

            $credentials[$attribute] = $loginValue;
            unset($credentials[$multiLoginAttribute]);

            return $attribute;
        }

        foreach ($loginModes as $key => $attribute) {
            if (array_key_exists($attribute, $credentials)) {
                return $attribute;
            }
        }

        return null;
    }
}
