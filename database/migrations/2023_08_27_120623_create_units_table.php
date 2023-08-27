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
            $table->id('unit_id');  
            $table->unsignedBigInteger('course_id')->comment('Course ID');// Assuming "courses" table
            $table->string('unit_name');
            $table->string('unit_title');
            $table->text('unit_description');
            $table->string('unit_image')->nullable();
            $table->integer('no_of_lessons');
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
