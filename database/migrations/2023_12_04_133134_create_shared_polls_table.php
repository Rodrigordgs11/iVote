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
        Schema::create('shared_polls', function (Blueprint $table) {
            $table->foreignUuid('user_uuid')->references('uuid')->on('users');
            $table->foreignUuid('poll_uuid')->references('uuid')->on('polls');
            $table->primary(['user_uuid', 'poll_uuid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shared_polls');
    }
};
