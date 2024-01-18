<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

		$table->increments('id_user',);
		$table->string('email');
		$table->string('password');
		$table->string('username');
		$table->string('firstname');
		$table->string('lastname');
		$table->string('city');
		$table->integer('postcode',);
		$table->integer('telephone');
		$table->string('profile_image');
		$table->string('profile_description');
		$table->datetime('created_at')->default('(');
		$table->enum('role',['superAdmin','communityAdmin','communityMod','user'])->default('user');
		$table->boolean('isActive')->default('1');

        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}