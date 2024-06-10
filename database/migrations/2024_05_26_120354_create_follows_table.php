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
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('followerId');
            $table->foreignId('followeeId');
            $table->foreign('followerId')->on('users')->references('id')->cascadeOnDelete();
            $table->foreign('followeeId')->on('users')->references('id')->cascadeOnDelete();
            $table->unique(['followerId', 'followeeId']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
