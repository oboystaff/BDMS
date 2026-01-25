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
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('client_id')->after('sales_id');
            $table->string('book_id')->after('client_id');
            $table->string('unit_price')->after('book_id');
            $table->string('quantity')->after('unit_price');
            $table->string('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('client_id');
            $table->dropColumn('book_id');
            $table->dropColumn('unit_price');
            $table->dropColumn('quantity');
            $table->dropColumn('created_by');
        });
    }
};
