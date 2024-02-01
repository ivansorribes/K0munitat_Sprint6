<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsPostsTable extends Migration
{
    public function up()
    {
        Schema::create('commentsPosts', function (Blueprint $table) {

        $table->id();
        $table->foreignId('id_post')->references('id')->on('posts');
		$table->foreignId('id_comment')->references('id')->on('comments');
        $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('commentsPosts');
    }
}