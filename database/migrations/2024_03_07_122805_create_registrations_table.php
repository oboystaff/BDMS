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
        Schema::create('registrations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reg_id')->unique();
            $table->string('reg_type_id');
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('category')->nullable();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_phone')->nullable();
            $table->string('contact_person_email')->nullable();
            $table->string('region_id');
            $table->string('zone_id');
            $table->string('territory_id');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('agent_id');
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
