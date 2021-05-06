<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_users_id')->index();
            $table->unsignedBigInteger('teacher_users_id')->index();
            $table->timestamps();
            
            $table->foreign('student_users_id')->references('id')->on('users');
            $table->foreign('teacher_users_id')->references('id')->on('users');
        });

        /*Schema::table('students', function($table) {
            $table->foreign('student_users_id')->references('id')->on('users');
            $table->foreign('teacher_users_id')->references('id')->on('users');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
