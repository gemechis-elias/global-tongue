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
        Schema::create('units', function (Blueprint $table) {
            $table->id();  
            $table->unsignedBigInteger('course_id')->comment('Course ID');// Assuming "courses" table
            $table->string('unit_name');
            $table->longText('unit_title');
            $table->longText('unit_description');
            $table->string('unit_image')->nullable();
            $table->integer('no_of_lessons');
            $table->unsignedBigInteger('user_id')->comment('Created By Admin');

            $table->foreign('user_id')->references('id')->on('users'); 
            $table->foreign('course_id')->references('id')->on('courses'); 
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
        Schema::dropIfExists('units');
    }
};
