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
		$table->integer('id_community')->constrained('communities');
		$table->integer('id_user')->constrained('users');
		$table->string('title',50);
		$table->string('description',1000);
		$table->string('category',35);
		$table->boolean('isActive')->default('1');
		$table->enum('type',['advertisement','post']);
		$table->datetime('created_at')->nullable();
        $table->datetime('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}