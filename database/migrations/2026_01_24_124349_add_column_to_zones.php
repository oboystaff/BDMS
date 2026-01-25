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
        Schema::table('zones', function (Blueprint $table) {
            $table->string('zonal_sales_officer_id')->after('name');
            $table->string('status')->after('zonal_sales_officer_id')->default('Active');
            $table->string('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zones', function (Blueprint $table) {
            $table->dropColumn('zonal_sales_officer_id');
            $table->dropColumn('status');
            $table->dropColumn('created_by');
        });
    }
};
