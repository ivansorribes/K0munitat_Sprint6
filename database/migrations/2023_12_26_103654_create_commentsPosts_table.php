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
        $table->integer('id_post')->constrained('posts');
		$table->integer('id_comment')->constrained('comments');
        $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('commentsPosts');
    }
}