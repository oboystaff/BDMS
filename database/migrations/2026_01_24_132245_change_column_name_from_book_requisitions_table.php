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
        Schema::table('book_requisitions', function (Blueprint $table) {
            $table->renameColumn('agent_id', 'zonal_sales_officer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_requisitions', function (Blueprint $table) {
            $table->renameColumn('zonal_sales_officer_id', 'agent_id');
        });
    }
};
