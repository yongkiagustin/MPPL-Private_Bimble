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
        
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();

        });
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });
        Schema::create('staff_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('staff_id');
            $table->unsignedBiginteger('course_id');
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('staff');
            $table->foreign('course_id')->references('id')->on('courses');
        });

        

        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('classroom_student', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('classroom_id');
            $table->unsignedBiginteger('student_id');
            $table->timestamps();

            $table->foreign('classroom_id')->references('id')->on('classrooms');
            $table->foreign('student_id')->references('id')->on('students');
        });
        Schema::create('course_program', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('program_id');
            $table->unsignedBiginteger('course_id');
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('classrooms');
            $table->foreign('course_id')->references('id')->on('courses');
        });
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('staff_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('staff_id');
            $table->unsignedBiginteger('role_id');
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('staff');
            $table->foreign('role_id')->references('id')->on('roles');
        });
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('answer_a');
            $table->string('answer_b');
            $table->string('answer_c');
            $table->string('answer_d');
            $table->string('answer_e');
            $table->unsignedBiginteger('course_id');
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses');
        });
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('student_id');
            $table->unsignedBiginteger('exam_id');
            $table->string('answer');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('exam_id')->references('id')->on('exams');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
