<?php

namespace Database\Seeders;

use App\Enums\SubCategoryStatusEnum;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            [
                'category_id' => 1,
                'name_en' => 'Hospitals',
                'name_ar' => 'المستشفيات',
                'description_en' => 'Facilities providing comprehensive medical care and inpatient services.',
                'description_ar' => 'مرافق تقدم رعاية طبية شاملة وخدمات للمرضى الداخليين.',
            ],
            [
                'category_id' => 1,
                'name_en' => 'Clinics',
                'name_ar' => 'العيادات',
                'description_en' => 'Outpatient centers offering general or specialized healthcare.',
                'description_ar' => 'مراكز خارجية تقدم رعاية صحية عامة أو متخصصة.',
            ],
            [
                'category_id' => 1,
                'name_en' => 'Pharmacies',
                'name_ar' => 'الصيدليات',
                'description_en' => 'Retail locations for dispensing medications and health products.',
                'description_ar' => 'أماكن بيع الأدوية والمنتجات الصحية.',
            ],
            [
                'category_id' => 1,
                'name_en' => 'Emergency Services',
                'name_ar' => 'خدمات الطوارئ',
                'description_en' => 'Immediate medical response units for urgent health situations.',
                'description_ar' => 'وحدات طبية للاستجابة الفورية للحالات الصحية الطارئة.',
            ],
            [
                'category_id' => 2,
                'name_en' => 'Schools',
                'name_ar' => 'المدارس',
                'description_en' => 'Institutions for primary and secondary education.',
                'description_ar' => 'مؤسسات التعليم الأساسي والثانوي.',
            ],
            [
                'category_id' => 2,
                'name_en' => 'Universities',
                'name_ar' => 'الجامعات',
                'description_en' => 'Higher education institutions offering degrees and research programs.',
                'description_ar' => 'مؤسسات التعليم العالي التي تقدم درجات علمية وبرامج بحثية.',
            ],
            [
                'category_id' => 2,
                'name_en' => 'Vocational Training',
                'name_ar' => 'التدريب المهني',
                'description_en' => 'Programs focused on skill development for specific trades or careers.',
                'description_ar' => 'برامج تركز على تطوير المهارات لمهن أو وظائف محددة.',
            ],
            [
                'category_id' => 3,
                'name_en' => 'Public Transport',
                'name_ar' => 'النقل العام',
                'description_en' => 'Systems for mass transit including buses, trains, and metro.',
                'description_ar' => 'أنظمة النقل الجماعي مثل الحافلات والقطارات والمترو.',
            ],
            [
                'category_id' => 3,
                'name_en' => 'Vehicle Registration',
                'name_ar' => 'تسجيل المركبات',
                'description_en' => 'Government services for registering and licensing vehicles.',
                'description_ar' => 'خدمات حكومية لتسجيل وترخيص المركبات.',
            ],
            [
                'category_id' => 3,
                'name_en' => 'Driving Licenses',
                'name_ar' => 'رخص القيادة',
                'description_en' => 'Issuance and renewal of driver’s licenses.',
                'description_ar' => 'إصدار وتجديد رخص القيادة.',
            ],
            [
                'category_id' => 4,
                'name_en' => 'Banking',
                'name_ar' => 'الخدمات المصرفية',
                'description_en' => 'Financial services including savings, loans, and accounts.',
                'description_ar' => 'خدمات مالية تشمل الادخار والقروض والحسابات.',
            ],
            [
                'category_id' => 4,
                'name_en' => 'Taxes',
                'name_ar' => 'الضرائب',
                'description_en' => 'Government services for tax filing and payment.',
                'description_ar' => 'خدمات حكومية لتقديم ودفع الضرائب.',
            ],
            [
                'category_id' => 4,
                'name_en' => 'Investments',
                'name_ar' => 'الاستثمارات',
                'description_en' => 'Opportunities and services for financial growth and asset management.',
                'description_ar' => 'فرص وخدمات للنمو المالي وإدارة الأصول.',
            ],
            [
                'category_id' => 5,
                'name_en' => 'Court Services',
                'name_ar' => 'خدمات المحاكم',
                'description_en' => 'Legal proceedings and administrative support within the judiciary.',
                'description_ar' => 'الإجراءات القانونية والدعم الإداري داخل النظام القضائي.',
            ],
            [
                'category_id' => 5,
                'name_en' => 'Notary',
                'name_ar' => 'التوثيق',
                'description_en' => 'Official authentication of documents and contracts.',
                'description_ar' => 'توثيق رسمي للمستندات والعقود.',
            ],
            [
                'category_id' => 5,
                'name_en' => 'Legal Aid',
                'name_ar' => 'المساعدة القانونية',
                'description_en' => 'Support and representation for individuals in legal matters.',
                'description_ar' => 'الدعم والتمثيل القانوني للأفراد في القضايا القانونية.',
            ],
            [
                'category_id' => 6,
                'name_en' => 'Real Estate',
                'name_ar' => 'العقارات',
                'description_en' => 'Services related to property buying, selling, and renting.',
                'description_ar' => 'خدمات تتعلق بشراء وبيع وتأجير العقارات.',
            ],
            [
                'category_id' => 6,
                'name_en' => 'Utilities',
                'name_ar' => 'المرافق',
                'description_en' => 'Access to essential services like water, electricity, and gas.',
                'description_ar' => 'الوصول إلى خدمات أساسية مثل الماء والكهرباء والغاز.',
            ],
            [
                'category_id' => 6,
                'name_en' => 'Building Permits',
                'name_ar' => 'تصاريح البناء',
                'description_en' => 'Authorization for construction and property development.',
                'description_ar' => 'تصاريح للبناء وتطوير العقارات.',
            ],
            [
                'category_id' => 7,
                'name_en' => 'Company Registration',
                'name_ar' => 'تسجيل الشركات',
                'description_en' => 'Processes for legally establishing a business entity.',
                'description_ar' => 'إجراءات تأسيس كيان تجاري بشكل قانوني.',
            ],
            [
                'category_id' => 7,
                'name_en' => 'Licenses',
                'name_ar' => 'التراخيص',
                'description_en' => 'Permits required to operate specific types of businesses.',
                'description_ar' => 'تصاريح مطلوبة لتشغيل أنواع معينة من الأعمال.',
            ],
            [
                'category_id' => 7,
                'name_en' => 'Trade',
                'name_ar' => 'التجارة',
                'description_en' => 'Commercial exchange of goods and services across markets.',
                'description_ar' => 'التبادل التجاري للسلع والخدمات عبر الأسواق.',
            ],
        ];

        foreach ($subcategories as $subcategoryData) {
            $subcategory = Subcategory::firstOrNew([
                'category_id' => $subcategoryData['category_id'],
                'name->en' => $subcategoryData['name_en'],
            ]);

            $subcategory->setTranslations('name', [
                'en' => $subcategoryData['name_en'],
                'ar' => $subcategoryData['name_ar'],
            ]);


            $subcategory->setTranslations('description', [
                'en' => $subcategoryData['description_en'],
                'ar' => $subcategoryData['description_ar'],
            ]);

            $subcategory->category_id = $subcategoryData['category_id'];
            $subcategory->status = SubCategoryStatusEnum::ACTIVE->value;
            $subcategory->save();
        }
    }

}
