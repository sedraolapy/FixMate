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

        if ($categories->isEmpty() || $states->isEmpty()) {
            $this->command->error('Ensure categories and states with subcategories and cities exist.');
            return;
        }

        $serviceProviders = [
            [
                'name' => 'Ali Hamdan',
                'shop_name' => 'Ali Electronics',
                'description' => 'Expert in home electronics and gadgets.',
                'phone_number' => '123456789',
                'whatsapp' => '123456789',
                'facebook' => 'https://facebook.com/alielectronics',
                'instagram' => 'https://instagram.com/alielectronics',
                'start_date' => now()->subMonths(3),
                'end_date' => now()->addMonths(3),
                'status' => collect($statuses)->random(),
                'views' => 150,
            ],
            [
                'name' => 'Samar Saleh',
                'shop_name' => 'Samar Beauty Salon',
                'description' => 'Beauty services for all occasions.',
                'phone_number' => '987654321',
                'whatsapp' => null,
                'facebook' => null,
                'instagram' => 'https://instagram.com/samarbeauty',
                'start_date' => now()->subMonths(2),
                'end_date' => now()->addMonths(4),
                'status' => collect($statuses)->random(),
                'views' => 90,
            ],
            [
                'name' => 'Omar Khaled',
                'shop_name' => 'Omar Car Services',
                'description' => 'Car maintenance and detailing.',
                'phone_number' => '111222333',
                'whatsapp' => '111222333',
                'facebook' => 'https://facebook.com/omarcar',
                'instagram' => null,
                'start_date' => now()->subMonths(6),
                'end_date' => null,
                'status' => collect($statuses)->random(),
                'views' => 70,
            ],
            [
                'name' => 'Lina Youssef',
                'shop_name' => 'Lina Photography',
                'description' => 'Professional photography services.',
                'phone_number' => '444555666',
                'whatsapp' => '444555666',
                'facebook' => null,
                'instagram' => 'https://instagram.com/linaphoto',
                'start_date' => now()->subMonth(),
                'end_date' => now()->addMonths(2),
                'status' => collect($statuses)->random(),
                'views' => 200,
            ],
            [
                'name' => 'Hassan Nader',
                'shop_name' => 'Hassan Tech Repairs',
                'description' => 'Fast tech repair services.',
                'phone_number' => '777888999',
                'whatsapp' => null,
                'facebook' => 'https://facebook.com/hassantech',
                'instagram' => null,
                'start_date' => now()->subMonths(5),
                'end_date' => now()->addMonths(1),
                'status' => collect($statuses)->random(),
                'views' => 180,
            ],
        ];

        foreach ($serviceProviders as $data) {
            $category = $categories->random();
            $subCategory = $category->subCategories->first();
            $state = $states->random();
            $city = $state->cities->first();

            if (!$subCategory || !$city) {
                continue;
            }

            ServiceProvider::create(array_merge($data, [
                'thumbnail' => null,
                'category_id' => $category->id,
                'sub_category_id' => $subCategory->id,
                'state_id' => $state->id,
                'city_id' => $city->id,
            ]));
        }
    }
}
