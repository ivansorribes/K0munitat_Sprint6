<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {

		$table->integer('id_post',);
		$table->integer('id_community',);
		$table->integer('id_user',);
		$table->string('title',50);
		$table->string('description',1000);
		$table->string('category',35);
		$table->datetime('date_published')->default('(');
		$table->boolean('isActive')->default('1');
		$table->enum('type',['advertisement','post']);
		$table->foreign('id_community')->references('id_community')->on('communities');		$table->foreign('id_user')->references('id_user')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}