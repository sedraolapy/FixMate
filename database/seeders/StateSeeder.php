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
            [
                'name_en' => 'Syria',
                'name_ar' => 'سوريا',
            ],
            [
                'name_en' => 'Lebanon',
                'name_ar' => 'لبنان',
            ],
            [
                'name_en' => 'United Arab Emirates',
                'name_ar' => 'الإمارات العربية المتحدة',
            ],
        ];
        foreach ($states as $stateData) {
            $translations = [
                'en' => $stateData['name_en'],
                'ar' => $stateData['name_ar'],
            ];

            $state = State::firstOrNew([
                'name->en' => $translations['en'],
            ]);

            $state->setTranslations('name', $translations);
            $state->status = StateStatusEnum::ACTIVE->value;
            $state->save();
        }

    }
}
