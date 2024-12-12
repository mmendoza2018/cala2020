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
        Schema::create('attention_numbers', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('name'); // Nombre del contacto o servicio
            $table->string('phone_number'); // Número de atención
            $table->string('type')->nullable(); // Tipo de contacto (ej. soporte, ventas, etc.)
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attention_numbers');
    }
};
