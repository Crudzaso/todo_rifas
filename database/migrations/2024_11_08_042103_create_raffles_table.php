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
        Schema::create('raffles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('lottery');
            $table->enum('type', ['ticket', 'bet']);
            $table->integer('tickets_count');
            $table->decimal('ticket_price');
            $table->timestamp('raffle_date');
            $table->boolean('active')->default(true);
            $table->decimal('total_bet_pool')->default(0.00);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raffles');
    }
};
