<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunitiesTable extends Migration
{
    public function up()
    {
        Schema::create('communities', function (Blueprint $table) {

        $table->id();
        $table->foreignId('id_admin')->constrained('users');
		$table->string('name');
		$table->string('description');
		$table->foreignId('id_autonomousCommunity')->constrained('autonomousCommunities');
		$table->foreignId('id_region')->constrained('regions');
        $table->boolean('private')->default('1');
		$table->datetime('created_at')->nullable();
        $table->datetime('updated_at')->nullable();
		$table->boolean('isActive')->default('1');

        });
    }

    public function down()
    {
        Schema::dropIfExists('communities');
    }
}