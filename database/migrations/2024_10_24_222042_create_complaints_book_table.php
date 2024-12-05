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
        Schema::create('complaints_book', function (Blueprint $table) {
            $table->id();

            // Datos del cliente
            $table->string('first_name', 100); // Nombres
            $table->string('last_name', 100); // Primer apellido
            $table->string('second_last_name', 100)->nullable(); // Segundo apellido
            $table->string('document_type', 20); // Tipo de documento (DNI, CE, PASAPORTE)
            $table->string('document_number', 20); // Número de documento
            $table->string('phone_number', 20); // Celular
            $table->string('state', 50); // Departamento
            $table->string('province', 50); // Provincia
            $table->string('district', 50); // Distrito
            $table->string('address', 255)->nullable(); // Dirección
            $table->text('address_references')->nullable(); // Referencias de la dirección
            $table->string('email', 100)->nullable(); // Correo electrónico
            $table->boolean('is_minor')->default(0); // Menor de edad (0 para no, 1 para sí)

            // Datos del apoderado (nullable en caso de no ser menor de edad)
            $table->string('guardian_document_type', 20)->nullable(); // Tipo de documento del apoderado
            $table->string('guardian_document_number', 20)->nullable(); // Número de documento del apoderado
            $table->string('guardian_phone_number', 20)->nullable(); // Celular del apoderado
            $table->string('guardian_first_name', 100)->nullable(); // Nombres del apoderado
            $table->string('guardian_last_name', 100)->nullable(); // Primer apellido del apoderado
            $table->string('guardian_second_last_name', 100)->nullable(); // Segundo apellido del apoderado

            // Detalles del reclamo
            $table->enum('claim_type', ['Queja', 'Reclamo']); // Motivo (queja o reclamo)
            $table->string('receipt_number', 50)->nullable(); // Número o código de comprobante
            $table->text('claim_details'); // Detalle del reclamo o queja
            $table->text('customer_request'); // Pedido o solicitud del cliente
            $table->date('purchase_date')->nullable(); // Fecha de compra
            $table->text('response')->nullable(); // Fecha de compra
            $table->date('response_date')->nullable(); // Fecha de compra

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints_book');
    }
};
