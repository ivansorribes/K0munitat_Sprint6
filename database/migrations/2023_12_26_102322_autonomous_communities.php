<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComunitatsAutonomesTable extends Migration
{
    public function up()
    {
        Schema::create('comunitats_autonomes', function (Blueprint $table) {

		$table->integer('id_comunitat_autonoma',);
		$table->string('name');

        });
    }

    public function down()
    {
        Schema::dropIfExists('comunitats_autonomes');
    }
}