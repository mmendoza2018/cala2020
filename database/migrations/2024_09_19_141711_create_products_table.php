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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code');
            $table->text('description');
            $table->string('slug')->unique(); // Agregar el campo slug
            $table->json('images');
            $table->json('documents')->nullable();
            $table->json('min_stock');
            $table->json('promotion_links')->nullable();
            $table->boolean('status_on_website')->default(true);
            $table->boolean('status_on_catalog')->default(true);
            $table->boolean('status')->default(true);
            $table->foreignId('product_brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('measurement_unit_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('category_product_id')->constrained('categories_products')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
