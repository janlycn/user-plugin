<?php namespace RainLab\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use RainLab\User\Models\User;

class UsersUpdateEmailUsername extends Migration
{
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->string('email')->nullable()->unique()->change();
            $table->string('username')->nullable(false)->unique()->change();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'email')) {
            Schema::table('users', function($table)
            {
                $table->string('email')->nullable(false)->change();
                $table->dropUnique('users_email_unique');
            });
        }

        if (Schema::hasColumn('users', 'username')) {
            Schema::table('users', function($table)
            {
                $table->string('username')->nullable()->change();
                $table->dropUnique('users_username_unique');
            });
        }
    }
}
