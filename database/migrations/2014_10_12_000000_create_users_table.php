<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

        $table->id();
        $table->string('email');
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->string('username');
        $table->string('firstname')->nullable();
        $table->string('lastname')->nullable();
        $table->string('city')->nullable();
        $table->integer('postcode',)->nullable();
        $table->string('telephone')->nullable();
        $table->string('profile_image')->nullable();
        $table->string('profile_description')->nullable();
        $table->enum('role',['superAdmin','communityAdmin','communityMod','user'])->default('user');
        $table->rememberToken();
        $table->timestamps();
        $table->boolean('isActive')->default('1');

        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}