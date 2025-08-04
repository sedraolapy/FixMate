<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\ServiceProvider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provider1 = ServiceProvider::inRandomOrder()->first();
        $provider2 = ServiceProvider::inRandomOrder()->skip(1)->first();

        Offer::create([
            'title' => 'Summer Discount 25%',
            'image' => null,
            'service_provider_id' => $provider1->id,
            'start_date' => now()->subDays(5),
            'expire_date' => now()->addDays(10),
            'status' => 'active',
        ]);

        Offer::create([
            'title' => 'Back to School Sale',
            'image' => null ,
            'service_provider_id' => $provider2->id,
            'start_date' => now(),
            'expire_date' => now()->addDays(30),
            'status' => 'inactive',
        ]);
    }
}
