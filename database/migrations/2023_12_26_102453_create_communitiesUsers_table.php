<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunitiesUsersTable extends Migration
{
    public function up()
    {
        Schema::create('communitiesUsers', function (Blueprint $table) {

        $table->id();
        $table->foreignId('id_community')->references('id')->on('communities');
		$table->foreignId('id_user')->references('id')->on('users');
        $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('communitiesUsers');
    }
}