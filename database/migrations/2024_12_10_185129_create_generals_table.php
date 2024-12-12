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
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('business_name', 255);
            $table->string('ruc', 20);
            $table->string('address', 255);
            $table->string('email', 255);
            $table->text('description');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->boolean('brand_is_active')->default(false);
            $table->boolean('subcategory_is_active')->default(false);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generals');
    }
};
