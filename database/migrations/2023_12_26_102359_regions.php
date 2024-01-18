<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComarquesTable extends Migration
{
    public function up()
    {
        Schema::create('comarques', function (Blueprint $table) {

		$table->integer('id_comarca',);
		$table->integer('id_comunitat_autonoma',);
		$table->string('name');
		$table->foreign('id_comunitat_autonoma')->references('id_comunitat_autonoma')->on('comunitats_autonomes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comarques');
    }
}