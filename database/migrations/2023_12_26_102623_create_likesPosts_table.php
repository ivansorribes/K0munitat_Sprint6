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
        $table->integer('id_user')->constrained('users');;
		$table->integer('id_post')->constrained('posts');
        $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('likes_posts');
    }
}