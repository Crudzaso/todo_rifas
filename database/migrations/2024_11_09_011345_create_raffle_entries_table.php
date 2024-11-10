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
        Schema::create('raffle_entries', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->foreignId('raffle_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['ticket', 'bet']);
            $table->decimal('price', 8, 2);
            $table->decimal('min_bet', 8, 2);
            $table->decimal('max_bet', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raffle_entries');
    }
};
