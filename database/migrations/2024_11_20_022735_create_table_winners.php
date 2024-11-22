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
        Schema::create('winner', function (Blueprint $table) {
            $table->id();
            $table->string('participant_name');
            $table->string('lottery');
            $table->string('winning_number');
            $table->date('lottery_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('winner', function (Blueprint $table) {
            //
        });
    }
};
