<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagePostTable extends Migration
{
    public function up()
    {
        Schema::create('imagePost', function (Blueprint $table) {

        $table->id();
		$table->foreignId('id_post')->references('id')->on('posts');
		$table->string('name');
		$table->boolean('front_page')->default('0');
        $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('imagePost');
    }
}