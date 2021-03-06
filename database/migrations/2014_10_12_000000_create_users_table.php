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

        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('program_id')->constrained();
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->foreignId('classroom_id')->constrained();
            $table->foreignId('program_id')->constrained();
            $table->timestamps();
        });

        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->text('question')->nullable();
            $table->text('image')->nullable();
            $table->text('answer_a')->nullable();
            $table->text('answer_b')->nullable();
            $table->text('answer_c')->nullable();
            $table->text('answer_d')->nullable();
            $table->text('answer_e')->nullable();
            $table->foreignId('course_id')->constrained();
            $table->timestamps();

        });

        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('exam_id')->constrained();
            $table->string('answer');
            $table->timestamps();
        });

        /*
        Schema::create('staff_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('staff_id');
            $table->unsignedBiginteger('course_id');
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('staff');
            $table->foreign('course_id')->references('id')->on('courses');
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
        */
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('programs');
        Schema::dropIfExists('students');
        Schema::dropIfExists('classrooms');
        Schema::dropIfExists('exams');
        Schema::dropIfExists('answers');
//        Schema::dropIfExists('staff_course');
//        Schema::dropIfExists('classroom_student');
//        Schema::dropIfExists('course_program');
//        Schema::dropIfExists('roles');
//        Schema::dropIfExists('staff_role');
    }
}
