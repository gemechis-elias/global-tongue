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
           
            $table->id();
            $table->integer('course_id')->comment('Course ID');
            $table->integer('level_id')->comment('Level ID');
            $table->integer('unit_id')->comment('Unit ID');
            $table->longText('lesson_title');
            $table->string('lesson_type');
            $table->string('lesson_cover')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->comment('Created By Admin');

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('lessons');
    }
};
