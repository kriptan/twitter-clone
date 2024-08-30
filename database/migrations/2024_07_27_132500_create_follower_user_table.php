<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * PIVOT TABLE
     * Creates the 'follower_user' table with an auto-incrementing primary key and timestamps.
     * This table is used to store the many-to-many relationship between users who follow each other.
     *
     * https://laravel.com/docs/11.x/eloquent-relationships#many-to-many
     */
    public function up(): void
    {
        Schema::create('follower_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('follower_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follower_user');
    }
};
