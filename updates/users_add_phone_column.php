<?php namespace RainLab\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use RainLab\User\Models\User;

class UsersAddPhoneColumn extends Migration
{
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->string('phone')->nullable()->after('username')->unique();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'phone')) {
            Schema::table('users', function($table)
            {
                $table->dropColumn('phone');
            });
        }
    }
}