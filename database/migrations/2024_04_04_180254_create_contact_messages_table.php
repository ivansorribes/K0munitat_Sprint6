<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contactMessages', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name', 50);
            $table->string('phone');
            $table->string('sender_email', 50);
            $table->string('subject', 50);
            $table->text('message');
            $table->boolean('read')->default(false);
            $table->foreignId('id_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactMessages');

    }
};
