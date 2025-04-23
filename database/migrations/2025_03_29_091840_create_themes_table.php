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
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('primary_color', 7); // Color principal HEX
            $table->string('secondary_color', 7); // Color secundario HEX
            $table->enum('product_card_shape', ['SQUARE', 'RECTANGLE']); // Forma de la card
            $table->enum('theme_active', ['THEME_01', 'THEME_02'])->default('THEME_01'); // Estado del tema
            $table->tinyInteger('status')->default(1); // Estado (1 = activo, 0 = inactivo)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('themes');
    }
};
