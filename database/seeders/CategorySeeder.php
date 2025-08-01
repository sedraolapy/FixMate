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
            ['name' => 'Home Services', 'description' => 'Maintenance and repair professionals.'],
            ['name' => 'Education', 'description' => 'Tutors, trainers, and learning support.'],
            ['name' => 'Beauty & Wellness', 'description' => 'Personal care and wellness experts.'],
            ['name' => 'Tech Support', 'description' => 'IT, troubleshooting, and setup services.'],
            ['name' => 'Design & Creative', 'description' => 'Graphics, branding, and visual content.'],
            ['name' => 'Events', 'description' => 'Planners, decorators, and event support.'],
            ['name' => 'Automotive', 'description' => 'Car care, mechanics, and detailing.'],
            ['name' => 'Legal & Finance', 'description' => 'Consultants, advisors, and documentation.'],
            ['name' => 'Healthcare', 'description' => 'Nurses, therapists, and caregivers.'],
            ['name' => 'Cleaning Services', 'description' => 'Housekeeping and deep cleaning pros.'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'description' => $category['description'],
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

}
