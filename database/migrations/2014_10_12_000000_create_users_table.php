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
            $table->string('user_name')->primary()->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            // $table->time('time_created');
            // $table->date('login_date');
            // $table->time('login_time');
            // $table->date('logout_date');
            // $table->time('logout_time');

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
