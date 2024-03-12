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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('payment_id')->unique();
            $table->string('invoice_id');
            $table->string('reference')->unique();
            $table->string('amount');
            $table->string('payment_method');
            $table->string('receipt_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('status');
            $table->string('phone');
            $table->string('network');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
