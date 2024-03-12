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
        Schema::create('book_requisitions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('req_id')->unique();
            $table->string('agent_id');
            $table->string('book_id');
            $table->string('level_id');
            $table->string('quantity');
            $table->string('amount');
            $table->string('status');
            $table->string('approved_by')->nullable();
            $table->string('approved_date')->nullable();
            $table->string('pickup_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_requisitions');
    }
};
