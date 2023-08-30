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
        Schema::create('lessons', function (Blueprint $table) {
           
            $table->id('lesson_id');
            $table->unsignedBigInteger('unit_id')->comment('Unit ID');
            $table->unsignedBigInteger('course_id')->comment('Course ID');
            $table->string('lesson_title');
            $table->string('lesson_type');
            $table->string('lesson_cover')->nullable();
            $table->unsignedBigInteger('user_id')->comment('Created By Admin');
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
        Schema::dropIfExists('lessons');
    }
};
