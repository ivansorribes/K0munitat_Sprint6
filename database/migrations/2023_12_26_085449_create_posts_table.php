<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {

        $table->id();
		$table->foreignId('id_user')->references('id')->on('users');
        $table->foreignId('id_category')->references('id')->on('categories');
        $table->foreignId('id_community')->references('id')->on('communities');
		$table->string('title',50);
		$table->string('description',1000);
		$table->boolean('isActive')->default('1');
        $table->boolean('private')->default('1');
        $table->string('type', 50); 
        $table->boolean('post_blog')->default('0'); 
		$table->datetime('created_at')->nullable();
        $table->datetime('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}