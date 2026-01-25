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
        Schema::table('client_requests', function (Blueprint $table) {
            $table->dropColumn('sales_type_id');
            $table->string('subject_id')->after('book_id');
            $table->string('unit_price')->after('level_id');
            $table->string('created_by')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_requests', function (Blueprint $table) {
            $table->string('sales_type_id');
            $table->dropColumn('subject_id');
            $table->dropColumn('unit_price');
            $table->dropColumn('created_by');
        });
    }
};
