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
        Schema::create('votes', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('option_uuid')->references('uuid')->on('options')->onDelete('cascade');
            $table->foreignUuid('poll_uuid')->references('uuid')->on('polls')->onDelete('cascade');
            $table->foreignUuid('user_uuid')->references('uuid')->on('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
