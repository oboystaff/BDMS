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
        Schema::table('book_returns', function (Blueprint $table) {
            $table->string('zonal_sales_officer_id')->after('req_id');
            $table->string('book_id')->after('zonal_sales_officer_id');
            $table->string('created_by')->after('received_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_returns', function (Blueprint $table) {
            $table->dropColumn('zonal_sales_officer_id');
            $table->dropColumn('book_id');
            $table->dropColumn('created_by');
        });
    }
};
