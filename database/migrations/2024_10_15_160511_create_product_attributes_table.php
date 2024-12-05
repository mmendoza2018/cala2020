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
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id(); // ID único
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Relación con la tabla de productos
            $table->string('reference')->nullable(); // Referencia del atributo
            $table->integer('stock')->default(0); // Cantidad disponible
            $table->decimal('default_price', 10, 2)->nullable(); // Precio por defecto
            $table->boolean('is_default')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps(); // Timestamps de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attributes');
    }
};
