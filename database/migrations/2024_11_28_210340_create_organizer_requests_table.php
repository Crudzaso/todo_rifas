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
        Schema::create('organizer_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Usuario solicitante
            $table->string('reason'); // Razón para ser organizador
            $table->string('document_number'); // Número de documento
            $table->string('document_photo'); // Foto del documento
            $table->string('contract'); //Contrato
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Estado de la solicitud
            $table->timestamps(); // Timestamps para fecha de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizer_requests');
    }
};
