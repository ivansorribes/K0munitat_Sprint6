<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunitiesTable extends Migration
{
    public function up()
    {
        Schema::create('communities', function (Blueprint $table) {

		$table->integer('id_community',);
		$table->integer('id_admin',);
		$table->string('name',35);
		$table->string('description',300);
		$table->integer('id_comunitat_autonoma',);
		$table->integer('id_comarca',);
		$table->datetime('created_at')->default('(');
		$table->boolean('isActive')->default('1');
		$table->foreign('id_admin')->references('id_user')->on('users');		
        $table->foreign('id_comunitat_autonoma')->references('id_comunitat_autonoma')->on('comunitats_autonomes');		
        $table->foreign('id_comarca')->references('id_comarca')->on('comarques');
        });
    }

    public function down()
    {
        Schema::dropIfExists('communities');
    }
}