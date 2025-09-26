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


        $government_entities = [
            [
                'name_en' => 'Ministry of Interior',
                'name_ar' => 'وزارة الداخلية',
            ],
            [
                'name_en' => 'Ministry of Defence',
                'name_ar' => 'وزارة الدفاع',
            ],
            [
                'name_en' => 'Ministry of Foreign Affairs and Expatriates',
                'name_ar' => 'وزارة الخارجية والمغتربين',
            ],
            [
                'name_en' => 'Ministry of Justice',
                'name_ar' => 'وزارة العدل',
            ],
            [
                'name_en' => 'Ministry of Awqaf',
                'name_ar' => 'وزارة الأوقاف',
            ],
            [
                'name_en' => 'Ministry of Higher Education',
                'name_ar' => 'وزارة التعليم العالي',
            ],
            [
                'name_en' => 'Ministry of Social and Labour Affairs',
                'name_ar' => 'وزارة الشؤون الاجتماعية والعمل',
            ],
            [
                'name_en' => 'Ministry of Finance',
                'name_ar' => 'وزارة المالية',
            ],
            [
                'name_en' => 'Ministry of Economy and Foreign Trade',
                'name_ar' => 'وزارة الاقتصاد والتجارة الخارجية',
            ],
            [
                'name_en' => 'Ministry of Health',
                'name_ar' => 'وزارة الصحة',
            ],
            [
                'name_en' => 'Ministry of Local Administration and Environment',
                'name_ar' => 'وزارة الإدارة المحلية والبيئة',
            ],
            [
                'name_en' => 'Ministry of Communications and Information Technology',
                'name_ar' => 'وزارة الاتصالات وتكنولوجيا المعلومات',
            ],
            [
                'name_en' => 'Ministry of Agriculture and Agrarian Reform',
                'name_ar' => 'وزارة الزراعة والإصلاح الزراعي',
            ],
            [
                'name_en' => 'Ministry of Education',
                'name_ar' => 'وزارة التربية',
            ],
            [
                'name_en' => 'Ministry of Public Works and Housing',
                'name_ar' => 'وزارة الأشغال العامة والإسكان',
            ],
            [
                'name_en' => 'Ministry of Finance',
                'name_ar' => 'وزارة المالية',
            ],
            [
                'name_en' => 'Ministry of Interior and Municipalities',
                'name_ar' => 'وزارة الداخلية والبلديات',
            ],
            [
                'name_en' => 'Ministry of Justice',
                'name_ar' => 'وزارة العدل',
            ],
            [
                'name_en' => 'Ministry of Education and Higher Education',
                'name_ar' => 'وزارة التربية والتعليم العالي',
            ],
            [
                'name_en' => 'Ministry of Public Health',
                'name_ar' => 'وزارة الصحة العامة',
            ],
            [
                'name_en' => 'Ministry of Economy and Trade',
                'name_ar' => 'وزارة الاقتصاد والتجارة',
            ],
            [
                'name_en' => 'Ministry of Energy and Water',
                'name_ar' => 'وزارة الطاقة والمياه',
            ],
            [
                'name_en' => 'Ministry of Environment',
                'name_ar' => 'وزارة البيئة',
            ],
            [
                'name_en' => 'Ministry of Agriculture',
                'name_ar' => 'وزارة الزراعة',
            ],
            [
                'name_en' => 'Ministry of Industry',
                'name_ar' => 'وزارة الصناعة',
            ],
            [
                'name_en' => 'Ministry of Public Works and Transport',
                'name_ar' => 'وزارة الأشغال العامة والنقل',
            ],
            [
                'name_en' => 'Ministry of Social Affairs',
                'name_ar' => 'وزارة الشؤون الاجتماعية',
            ],
            [
                'name_en' => 'Ministry of Youth and Sports',
                'name_ar' => 'وزارة الشباب والرياضة',
            ],
            [
                'name_en' => 'Ministry of Foreign Affairs and Emigrants',
                'name_ar' => 'وزارة الخارجية والمغتربين',
            ],
            [
                'name_en' => 'Ministry of Defense',
                'name_ar' => 'وزارة الدفاع',
            ],
            [
                'name_en' => 'Ministry of Interior',
                'name_ar' => 'وزارة الداخلية',
            ],
            [
                'name_en' => 'Ministry of Finance',
                'name_ar' => 'وزارة المالية',
            ],
            [
                'name_en' => 'Ministry of Foreign Affairs and International Cooperation',
                'name_ar' => 'وزارة الخارجية والتعاون الدولي',
            ],
            [
                'name_en' => 'Ministry of Defence',
                'name_ar' => 'وزارة الدفاع',
            ],
            [
                'name_en' => 'Ministry of Justice',
                'name_ar' => 'وزارة العدل',
            ],
            [
                'name_en' => 'Ministry of Education',
                'name_ar' => 'وزارة التربية والتعليم',
            ],
            [
                'name_en' => 'Ministry of Health and Prevention',
                'name_ar' => 'وزارة الصحة ووقاية المجتمع',
            ],
            [
                'name_en' => 'Ministry of Community Development',
                'name_ar' => 'وزارة تنمية المجتمع',
            ],
            [
                'name_en' => 'Ministry of Economy',
                'name_ar' => 'وزارة الاقتصاد',
            ],
            [
                'name_en' => 'Ministry of Energy and Infrastructure',
                'name_ar' => 'وزارة الطاقة والبنية التحتية',
            ],
            [
                'name_en' => 'Ministry of Industry and Advanced Technology',
                'name_ar' => 'وزارة الصناعة والتكنولوجيا المتقدمة',
            ],
            [
                'name_en' => 'Ministry of Human Resources and Emiratisation',
                'name_ar' => 'وزارة الموارد البشرية والتوطين',
            ],
            [
                'name_en' => 'Ministry of Culture and Youth',
                'name_ar' => 'وزارة الثقافة والشباب',
            ],
            [
                'name_en' => 'Ministry of Climate Change and Environment',
                'name_ar' => 'وزارة التغير المناخي والبيئة',
            ],
            [
                'name_en' => 'Ministry of Cabinet Affairs',
                'name_ar' => 'وزارة شؤون مجلس الوزراء',
            ],
        ];

        foreach ($government_entities as $entityData) {
            $entity = GovernmentEntity::firstOrNew([
                'name->en' => $entityData['name_en'],
            ]);

            $entity->setTranslations('name', [
                'en' => $entityData['name_en'],
                'ar' => $entityData['name_ar'],
            ]);

            $entity->image = null;
            $entity->phone_numbers =null;
            $entity->facebook = null;
            $entity->instagram = null;
            $entity->status = GovernmentEntityStatusEnum::ACTIVE;

            $entity->save();
        }

    }
}
