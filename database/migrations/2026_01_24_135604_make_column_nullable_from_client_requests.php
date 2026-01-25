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
            $table->string('book_id')->nullable()->change();
            $table->string('subject_id')->nullable()->change();
            $table->string('level_id')->nullable()->change();
            $table->string('unit_price')->nullable()->change();
            $table->string('quantity')->nullable()->change();
            $table->string('amount')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_requests', function (Blueprint $table) {
            $table->string('book_id')->nullable(false)->change();
            $table->string('subject_id')->nullable(false)->change();
            $table->string('level_id')->nullable(false)->change();
            $table->string('unit_price')->nullable(false)->change();
            $table->string('quantity')->nullable(false)->change();
            $table->string('amount')->nullable(false)->change();
        });
    }
};
