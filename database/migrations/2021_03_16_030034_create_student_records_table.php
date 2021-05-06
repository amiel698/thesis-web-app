<?php

use App\StudentRecords;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Faker\Factory as Faker;

class CreateStudentRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->index();
            $table->tinyInteger('grading');
            $table->string('difficulty');
            $table->double('score', 10, 2);
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_records');
    }
}
