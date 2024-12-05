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
        Schema::create('product_attribute_prices', function (Blueprint $table) {
            $table->id(); // ID único
            $table->foreignId('product_attribute_id')->constrained()->onDelete('cascade'); // Relación con la tabla product_attributes
            $table->foreignId('price_type_id')->constrained('price_types')->onDelete('cascade'); // Relación con la tabla price_types
            $table->decimal('price', 10, 2); // Precio del atributo
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attribute_prices');
    }
};
