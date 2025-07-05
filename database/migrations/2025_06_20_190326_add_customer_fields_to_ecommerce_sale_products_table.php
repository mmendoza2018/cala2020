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
        Schema::table('ecommerce_sale_products', function (Blueprint $table) {
            $table->string('first_name')->after('total');
            $table->string('last_name')->after('first_name');
            $table->string('phone_number')->after('last_name');
            $table->string('alternate_phone_number')->nullable()->after('phone_number');
            $table->string('email')->after('alternate_phone_number');
            $table->string('address')->after('email');
            $table->string('state')->after('address'); // o "department"
            $table->string('city')->after('state');
            $table->string('district')->after('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ecommerce_sale_products', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'phone_number',
                'alternate_phone_number',
                'email',
                'address',
                'state',
                'city',
                'district',
            ]);
        });
    }
};
