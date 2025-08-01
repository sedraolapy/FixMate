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
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('shop_name');

            $table->string('thumbnail')->nullable();

            $table->unsignedInteger('views')->default(0);

            $table->foreignId('category_id')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('sub_category_id')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('state_id')
            ->constrained()
            ->cascadeOnDelete();

            $table->foreignId('city_id')
            ->constrained()
            ->cascadeOnDelete();

            $table->string('phone_number');
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();


            $table->string('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_providers');
    }
};
