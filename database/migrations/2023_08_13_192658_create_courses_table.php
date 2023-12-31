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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('level')->nullable();
            $table->string('type')->nullable();
            $table->string('image')->nullable();
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
        // SET FOREIGN_KEY_CHECKS=0;
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('courses');
    }
};
