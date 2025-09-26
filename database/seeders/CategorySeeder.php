<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_en' => 'Healthcare',
                'name_ar' => 'الرعاية الصحية',
                'description_en' => 'Services related to medical care, wellness, and public health.',
                'description_ar' => 'الخدمات المتعلقة بالرعاية الطبية والصحة العامة والرفاهية.',
            ],
            [
                'name_en' => 'Education',
                'name_ar' => 'التعليم',
                'description_en' => 'Institutions and services focused on learning, teaching, and academic development.',
                'description_ar' => 'المؤسسات والخدمات التي تركز على التعلم والتعليم والتطوير الأكاديمي.',
            ],
            [
                'name_en' => 'Transportation',
                'name_ar' => 'النقل',
                'description_en' => 'Solutions for moving people and goods, including public and private transit.',
                'description_ar' => 'حلول لنقل الأشخاص والبضائع، بما في ذلك وسائل النقل العامة والخاصة.',
            ],
            [
                'name_en' => 'Finance',
                'name_ar' => 'المالية',
                'description_en' => 'Services related to banking, investments, insurance, and financial planning.',
                'description_ar' => 'الخدمات المتعلقة بالبنوك والاستثمار والتأمين والتخطيط المالي.',
            ],
            [
                'name_en' => 'Legal',
                'name_ar' => 'القانونية',
                'description_en' => 'Legal advice, representation, and documentation services.',
                'description_ar' => 'الخدمات القانونية مثل الاستشارات والتمثيل القانوني وتوثيق المستندات.',
            ],
            [
                'name_en' => 'Housing',
                'name_ar' => 'السكن',
                'description_en' => 'Services related to residential properties, rentals, and housing support.',
                'description_ar' => 'الخدمات المتعلقة بالمساكن والإيجارات والدعم السكني.',
            ],
            [
                'name_en' => 'Business',
                'name_ar' => 'الأعمال',
                'description_en' => 'Support for entrepreneurship, commercial services, and corporate solutions.',
                'description_ar' => 'دعم ريادة الأعمال والخدمات التجارية والحلول المؤسسية.',
            ],
        ];


        foreach ($categories as $category) {
            $cat = new Category();

            $cat->setTranslations('name', [
                'en' => $category['name_en'],
                'ar' => $category['name_ar'],
            ]);

            $cat->setTranslations('description', [
                'en' => $category['description_en'],
                'ar' => $category['description_ar'],
            ]);

            $cat->status = 'active';
            $cat->created_at = now();
            $cat->updated_at = now();
            $cat->save();
        }

    }

}
