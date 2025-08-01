<?php

namespace Database\Seeders;

use App\Enums\ServiceProviderStatusEnum;
use App\Models\Category;
use App\Models\ServiceProvider;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::with('subCategories')->get();
        $states = State::with('cities')->get();

        $statuses = ServiceProviderStatusEnum::cases();

        for ($i = 1; $i <= 20; $i++) {
            $category = $categories->random();
            if ($category->subCategories->isEmpty()) continue;

            $subCategory = $category->subCategories->random();

            $state = $states->random();
            if ($state->cities->isEmpty()) continue;

            $city = $state->cities->random();

            ServiceProvider::create([
                'name' => fake()->name(),
                'shop_name' => fake()->company(),
                'thumbnail' => null,
                'views' => rand(10, 500),
                'category_id' => $category->id,
                'sub_category_id' => $subCategory->id,
                'state_id' => $state->id,
                'city_id' => $city->id,
                'phone_number' => fake()->phoneNumber(),
                'whatsapp' => rand(0, 1) ? fake()->e164PhoneNumber() : null,
                'facebook' => rand(0, 1) ? 'https://facebook.com/' . Str::slug(fake()->company()) : null,
                'instagram' => rand(0, 1) ? 'https://instagram.com/' . Str::slug(fake()->company()) : null,
                'start_date' => fake()->dateTimeBetween('-1 year', 'now'),
                'end_date' => rand(0, 1) ? fake()->dateTimeBetween('now', '+1 year') : null,
                'status' => collect($statuses)->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
