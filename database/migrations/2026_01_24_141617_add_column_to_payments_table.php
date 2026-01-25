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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('client_id')->after('invoice_id');
            $table->string('book_id')->after('client_id');
            $table->string('invoice_id')->nullable()->change();
            $table->string('reference')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('network')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('client_id');
            $table->dropColumn('book_id');
            $table->string('invoice_id')->nullable(false)->change();
            $table->string('reference')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
            $table->string('network')->nullable(false)->change();
        });
    }
};
