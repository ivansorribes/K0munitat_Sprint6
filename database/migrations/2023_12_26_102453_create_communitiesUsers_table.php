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
        $table->integer('id_community')->constrained('communities');
		$table->integer('id_user')->constrained('users');
        $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('communitiesUsers');
    }
}