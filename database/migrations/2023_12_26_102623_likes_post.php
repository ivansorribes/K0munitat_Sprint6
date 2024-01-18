<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesPostsTable extends Migration
{
    public function up()
    {
        Schema::create('likes_posts', function (Blueprint $table) {

		$table->integer('id_like',);
		$table->integer('id_user',);
		$table->integer('id_post',);
		$table->foreign('id_user')->references('id_user')->on('users');		
        $table->foreign('id_post')->references('id_post')->on('posts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes_posts');
    }
}