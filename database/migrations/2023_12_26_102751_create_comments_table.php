<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {

        $table->id();
        $table->foreignId('id_user')->references('id')->on('users');
        $table->string('comment');
        $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}