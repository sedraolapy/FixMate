<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stateId = DB::table('states')->inRandomOrder()->first()?->id ?? 1;
        $cityId = DB::table('cities')->inRandomOrder()->first()?->id ?? 1;

        Customer::create([
            'first_name'    => 'John',
            'last_name'     => 'Doe',
            'phone_number'  => '0991234567',
            'image'         => 'images/customers/default.png',
            'state_id'      => $stateId,
            'city_id'       => $cityId,
            'status'        => 'active',
        ]);

        Customer::create([
            'first_name'    => 'Jane',
            'last_name'     => 'Smith',
            'phone_number'  => '0947654321',
            'image'         => 'images/customers/default.png',
            'state_id'      => $stateId,
            'city_id'       => $cityId,
            'status'        => 'inactive',
        ]);
    }
}
