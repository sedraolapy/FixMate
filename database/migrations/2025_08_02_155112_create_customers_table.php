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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');

            $table->string('last_name');

            $table->string('phone_number');

            $table->string('image')->nullable();

            $table->foreignId('state_id')
            ->constrained()
            ->cascadeOnDelete();

            $table->foreignId('city_id')
            ->constrained()
            ->cascadeOnDelete();

            $table->string('status');

            $table->string('password');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
