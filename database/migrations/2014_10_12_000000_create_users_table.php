<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('username')->primary()->unique();
            $table->string('password');
            $table->string('frist_name');
            $table->string('last_name');
            $table->tinyInteger('user_type');
            $table->date('date_created');
            $table->time('time_created');
            $table->date('login_date');
            $table->time('login_time');
            $table->date('logout_date');
            $table->time('logout_time');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
