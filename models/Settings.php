<?php namespace RainLab\User\Models;

use Model;

class Settings extends Model
{
    /**
     * @var array Behaviors implemented by this model.
     */
    public $implement = [
        \System\Behaviors\SettingsModel::class
    ];

    public $settingsCode = 'user_settings';
    public $settingsFields = 'fields.yaml';


    const ACTIVATE_AUTO = 'auto';
    const ACTIVATE_USER = 'user';
    const ACTIVATE_ADMIN = 'admin';

    const LOGIN_EMAIL = 'email';
    const LOGIN_USERNAME = 'username';
    const LOGIN_PHONE = 'phone';

    const REMEMBER_ALWAYS = 'always';
    const REMEMBER_NEVER = 'never';
    const REMEMBER_ASK = 'ask';

    const PHONE_SMS_CODE_LENGTH = 4;
    const PHONE_SMS_CODE_TIMEOUT = 10;
    const PHONE_SMS_RESEND_INTERVAL = 60;

    public function initSettingsData()
    {
        $this->require_activation = true;
        $this->activate_mode = self::ACTIVATE_AUTO;
        $this->use_throttle = true;
        $this->block_persistence = false;
        $this->allow_registration = true;
        $this->login_modes = [self::LOGIN_EMAIL];
        $this->remember_login = self::REMEMBER_ALWAYS;
        $this->use_register_throttle = true;
        $this->register_modes = [self::LOGIN_EMAIL];
        $this->sms_code_length = self::PHONE_SMS_CODE_LENGTH;
        $this->sms_code_timeout = self::PHONE_SMS_CODE_TIMEOUT;
        $this->sms_resend_interval = self::PHONE_SMS_RESEND_INTERVAL;
    }

    public function getActivateModeOptions()
    {
        return [
            self::ACTIVATE_AUTO => [
                'rainlab.user::lang.settings.activate_mode_auto',
                'rainlab.user::lang.settings.activate_mode_auto_comment'
            ],
            self::ACTIVATE_USER => [
                'rainlab.user::lang.settings.activate_mode_user',
                'rainlab.user::lang.settings.activate_mode_user_comment'
            ],
            self::ACTIVATE_ADMIN => [
                'rainlab.user::lang.settings.activate_mode_admin',
                'rainlab.user::lang.settings.activate_mode_admin_comment'
            ]
        ];
    }

    public function getActivateModeAttribute($value)
    {
        if (!$value) {
            return self::ACTIVATE_AUTO;
        }

        return $value;
    }

    public function getLoginModesOptions()
    {
        return [
            self::LOGIN_EMAIL => ['rainlab.user::lang.login.attribute_email'],
            self::LOGIN_USERNAME => ['rainlab.user::lang.login.attribute_username'],
            self::LOGIN_PHONE => ['手机']
        ];
    }

    public function getRegisterModesOptions()
    {
        return [
            self::LOGIN_EMAIL => ['rainlab.user::lang.login.attribute_email'],
            self::LOGIN_USERNAME => ['rainlab.user::lang.login.attribute_username'],
            self::LOGIN_PHONE => ['手机']
        ];
    }

    public function getRememberLoginOptions()
    {
        return [
            self::REMEMBER_ALWAYS => [
                'rainlab.user::lang.settings.remember_always',
            ],
            self::REMEMBER_NEVER => [
                'rainlab.user::lang.settings.remember_never',
            ],
            self::REMEMBER_ASK => [
                'rainlab.user::lang.settings.remember_ask',
            ]
        ];
    }

    public function getRememberLoginAttribute($value)
    {
        if (!$value) {
            return self::REMEMBER_ALWAYS;
        }

        return $value;
    }
}
