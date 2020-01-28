<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_program', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('program_id')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('programs')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_program');
    }
}
