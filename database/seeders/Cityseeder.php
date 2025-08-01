<?php

namespace Database\Seeders;

use App\Enums\CityStatusEnum;
use App\Models\City;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Cityseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Damascus' => ['Al-Muhajirin', 'Rukn al-Din', 'Kafr Sousa'],
            'Aleppo' => ['Al-Furqan', 'Suleimaniyah', 'Aziziyeh'],
            'Homs' => ['Al-Waer', 'Inshaat', 'Karm al-Shami'],
        ];

        foreach ($cities as $stateName => $cityList) {
            $state = State::where('name', $stateName)->first();

            if ($state) {
                foreach ($cityList as $cityName) {
                    City::updateOrCreate([
                        'name' => $cityName,
                        'state_id' => $state->id,
                        'status' => CityStatusEnum::ACTIVE->value,
                        ]);
                }
            }
        }
    }

}
