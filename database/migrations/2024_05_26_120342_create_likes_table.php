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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId');
            $table->foreignId('postId');
            $table->foreign('userId')->on('users')->references('id')->cascadeOnDelete();
            $table->foreign('postId')->on('posts')->references('id')->cascadeOnDelete();
            $table->unique(['userId', 'postId']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
