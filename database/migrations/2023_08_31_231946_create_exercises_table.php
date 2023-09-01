<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unit_id')->comment('Unit ID');
            $table->unsignedBigInteger('course_id')->comment('Course ID');
            $table->unsignedBigInteger('lesson_id')->comment('Lesson ID');
            $table->string('exercise_type');
            $table->longText('instruction');
            $table->longText('question');
            $table->string('image')->nullable();
            $table->string('voice')->nullable();
            $table->string('choices')->nullable();
            $table->longText('incorrect_hint')->nullable();
            $table->string('correct_answer')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->comment('Created By Admin');
 

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('lesson_id')->references('id')->on('lessons');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercises');
    }
};
