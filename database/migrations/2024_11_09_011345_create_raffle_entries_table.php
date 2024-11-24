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
            $table->id();
            $table->enum('type', ['ticket', 'bet']);
            $table->decimal('bet_amount')->default(0.00);
            $table->string('status');
            $table->integer('number')->unique();
            $table->decimal('price')->default(0.00);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('raffle_id')->constrained()->onDelete('cascade');
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
