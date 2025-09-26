<?php

use App\Enums\CityStatusEnum;
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
        Schema::create('cities', function (Blueprint $table) {
                $table->id();

                $table->json('name')->nullable();

                $table->foreignId('state_id')
                ->constrained()
                ->cascadeOnDelete();

                $table->string('status')->default(CityStatusEnum::ACTIVE->value);

                $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
