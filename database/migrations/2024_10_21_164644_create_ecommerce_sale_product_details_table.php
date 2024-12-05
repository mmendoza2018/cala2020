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
        Schema::create('ecommerce_sale_product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('ecommerce_sale_products')->onDelete('cascade');
            $table->foreignId('product_attribute_id')->constrained('product_attributes')->onDelete('cascade');
            $table->string('product_name'); // Nombre del producto en el momento de la venta
            $table->decimal('price', 10, 2); // Precio del producto en el momento de la venta
            $table->integer('quantity'); // Cantidad de productos vendidos
            $table->decimal('subtotal', 10, 2); // Subtotal (precio * cantidad)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecommerce_sale_product_details');
    }
};
