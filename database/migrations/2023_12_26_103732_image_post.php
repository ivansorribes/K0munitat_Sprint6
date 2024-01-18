<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagePostTable extends Migration
{
    public function up()
    {
        Schema::create('imagePost', function (Blueprint $table) {

		$table->integer('id_imagePost',);
		$table->integer('id_post',);
		$table->string('name');
		$table->boolean('portada')->default('0');
		$table->foreign('id_post')->references('id_post')->on('posts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagePost');
    }
}