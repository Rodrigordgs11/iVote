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
        Schema::create('polls', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('title');
            $table->string('description');
            $table->enum('poll_privacy', ['private', 'public']);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->foreignUuid('owner_uuid')->references('uuid')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polls');
    }
};