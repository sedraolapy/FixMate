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
            [
                'state_id' => 1,
                'name_en' => 'Damascus',
                'name_ar' => 'دمشق',
            ],
            [
                'state_id' => 1,
                'name_en' => 'Aleppo',
                'name_ar' => 'حلب',
            ],
            [
                'state_id' => 1,
                'name_en' => 'Homs',
                'name_ar' => 'حمص',
            ],
            [
                'state_id' => 1,
                'name_en' => 'Latakia',
                'name_ar' => 'اللاذقية',
            ],
            [
                'state_id' => 1,
                'name_en' => 'Hama',
                'name_ar' => 'حماة',
            ],
            [
                'state_id' => 1,
                'name_en' => 'Raqqa',
                'name_ar' => 'الرقة',
            ],
            [
                'state_id' => 1,
                'name_en' => 'Deir ez-Zor',
                'name_ar' => 'دير الزور',
            ],
            [
                'state_id' => 1,
                'name_en' => 'Al-Hasakah',
                'name_ar' => 'الحسكة',
            ],
            [
                'state_id' => 1,
                'name_en' => 'Qamishli',
                'name_ar' => 'القامشلي',
            ],
            [
                'state_id' => 1,
                'name_en' => 'Tartus',
                'name_ar' => 'طرطوس',
            ],
            [
                'state_id' => 2,
                'name_en' => 'Beirut',
                'name_ar' => 'بيروت',
            ],
            [
                'state_id' => 2,
                'name_en' => 'Tripoli',
                'name_ar' => 'طرابلس',
            ],
            [
                'state_id' => 2,
                'name_en' => 'Sidon',
                'name_ar' => 'صيدا',
            ],
            [
                'state_id' => 2,
                'name_en' => 'Baalbek',
                'name_ar' => 'بعلبك',
            ],
            [
                'state_id' => 2,
                'name_en' => 'Tyre',
                'name_ar' => 'صور',
            ],
            [
                'state_id' => 2,
                'name_en' => 'Nabatieh',
                'name_ar' => 'النبطية',
            ],
            [
                'state_id' => 2,
                'name_en' => 'Jounieh',
                'name_ar' => 'جونيه',
            ],
            [
                'state_id' => 2,
                'name_en' => 'Aley',
                'name_ar' => 'عاليه',
            ],
            [
                'state_id' => 2,
                'name_en' => 'Zahle',
                'name_ar' => 'زحلة',
            ],
            [
                'state_id' => 2,
                'name_en' => 'Mazraa',
                'name_ar' => 'المَزْرَعَة',
            ],
            [
                'state_id' => 3,
                'name_en' => 'Dubai',
                'name_ar' => 'دبي',
            ],
            [
                'state_id' => 3,
                'name_en' => 'Abu Dhabi',
                'name_ar' => 'أبو ظبي',
            ],
            [
                'state_id' => 3,
                'name_en' => 'Sharjah',
                'name_ar' => 'الشارقة',
            ],
            [
                'state_id' => 3,
                'name_en' => 'Al Ain',
                'name_ar' => 'العين',
            ],
            [
                'state_id' => 3,
                'name_en' => 'Ajman',
                'name_ar' => 'عجمان',
            ],
            [
                'state_id' => 3,
                'name_en' => 'Ras Al Khaimah',
                'name_ar' => 'رأس الخيمة',
            ],
            [
                'state_id' => 3,
                'name_en' => 'Fujairah',
                'name_ar' => 'الفجيرة',
            ],
            [
                'state_id' => 3,
                'name_en' => 'Umm Al Quwain',
                'name_ar' => 'أم القيوين',
            ],
            [
                'state_id' => 3,
                'name_en' => 'Kalba',
                'name_ar' => 'كلباء',
            ],
            [
                'state_id' => 3,
                'name_en' => 'Dibba Al-Fujairah',
                'name_ar' => 'دبا الفجيرة',
            ],
        ];

        foreach ($cities as $cityData) {
            $translations = [
                'en' => $cityData['name_en'],
                'ar' => $cityData['name_ar'],
            ];

            $city = City::firstOrNew([
                'name->en' => $translations['en'],
                'state_id' => $cityData['state_id'],
            ]);

            $city->setTranslations('name', $translations);
            $city->state_id = $cityData['state_id'];
            $city->status = CityStatusEnum::ACTIVE->value;
            $city->save();
        }

    }

}
