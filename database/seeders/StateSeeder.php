<?php

namespace Database\Seeders;

use App\Enums\StateStatusEnum;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            'Damascus',
            'Aleppo',
            'Homs',
            'Latakia',
            'Hama',
        ];

        foreach ($states as $name) {
            State::updateOrCreate([
                'name' => $name,
                'status' => StateStatusEnum::ACTIVE->value
            ]);
        }
    }
}
