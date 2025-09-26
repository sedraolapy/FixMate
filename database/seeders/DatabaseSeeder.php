<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

       $admin= Admin::updateOrCreate([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin135@@'),
            'name' => 'Sedra Alolapy',
            'phone_number' => '0992236800',
        ]);
        $admin->assignRole('admin');

        $this->call([
            StateSeeder::class,
            CitySeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            ServiceProviderSeeder::class,
            TagSeeder::class,
            OfferSeeder::class,
            GovernmentEntitySeeder::class,
            CustomerSeeder::class,
        ]);

    }
}
