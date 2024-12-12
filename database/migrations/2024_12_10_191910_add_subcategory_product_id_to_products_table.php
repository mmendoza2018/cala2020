<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Agregar la columna subcategory_product_id
            $table->unsignedBigInteger('subcategory_product_id')->nullable()->after('category_product_id');

            // Definir la clave foránea
            $table->foreign('subcategory_product_id')
                ->references('id')->on('subcategories_products')
                ->onDelete('cascade');
        });
    }

    /**
     * Revierte la migración.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Eliminar la clave foránea y la columna subcategory_product_id
            $table->dropForeign(['subcategory_product_id']);
            $table->dropColumn('subcategory_product_id');
        });
    }
};
