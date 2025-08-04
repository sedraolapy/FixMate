<?php

namespace Database\Seeders;

use App\Enums\GovernmentEntityStatusEnum;
use App\Models\GovernmentEntity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GovernmentEntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GovernmentEntity::create([
            'name' => 'Ministry of Health',
            'image' => null,
            'phone_numbers' => json_encode([
                ['number' => '555-000-1111'],
            ]),
            'facebook' => 'https://facebook.com/ministryofhealth',
            'instagram' => 'https://instagram.com/ministryofhealth',
            'status'  => GovernmentEntityStatusEnum::ACTIVE
        ]);

        GovernmentEntity::create([
            'name' => 'Ministry of Education',
            'image' =>null,
            'phone_numbers' => json_encode([
                    ['number' => '123-456-7890'],
                    ['number' => '098-765-4321'],
                ]),
            'facebook' => 'https://facebook.com/ministryofeducation',
            'instagram' => 'https://instagram.com/ministryofeducation',
            'status'  => GovernmentEntityStatusEnum::ACTIVE
        ]);
    }
}
