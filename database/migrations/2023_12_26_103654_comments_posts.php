<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsPostsTable extends Migration
{
    public function up()
    {
        Schema::create('commentsPosts', function (Blueprint $table) {

		$table->integer('id_comment_post',);
		$table->integer('id_post',);
		$table->integer('id_comment',);
		$table->foreign('id_post')->references('id_post')->on('posts');		$table->foreign('id_comment')->references('id_comment')->on('comments');
        });
    }

    public function down()
    {
        Schema::dropIfExists('commentsPosts');
    }
}