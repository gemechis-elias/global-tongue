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
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->string('course_id');
            $table->string('lesson_id');
            $table->string('completed');
            $table->string('date_completed');
            $table->string('payments');

            $table->unsignedBigInteger('user_id')->nullable()->comment('User ID');
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

        Schema::dropIfExists('progress');
    }
};
