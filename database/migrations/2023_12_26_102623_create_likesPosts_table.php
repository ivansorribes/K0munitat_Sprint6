<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesPostsTable extends Migration
{
    public function up()
    {
        Schema::create('likesPosts', function (Blueprint $table) {

        $table->id();
        $table->foreignId('id_user')->references('id')->on('users');
		$table->foreignId('id_post')->references('id')->on('posts');
        $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('likes_posts');
    }
}