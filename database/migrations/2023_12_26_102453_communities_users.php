<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunitiesUsersTable extends Migration
{
    public function up()
    {
        Schema::create('communitiesUsers', function (Blueprint $table) {

		$table->integer('id_community_user',);
		$table->integer('id_community',);
		$table->integer('id_user',);
		$table->foreign('id_community')->references('id_community')->on('communities');		$table->foreign('id_user')->references('id_user')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('communitiesUsers');
    }
}