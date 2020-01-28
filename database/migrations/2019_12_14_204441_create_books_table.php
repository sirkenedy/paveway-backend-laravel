<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->string('material');
            $table->string('publicId');
            $table->string('posted_by');
            $table->string('downloads')->nullable();
            $table->integer('likes')->nullable();
            $table->unsignedBigInteger('program_id')->nullable();
            $table->timestamps();

            
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
