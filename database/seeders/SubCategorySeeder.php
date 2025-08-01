<?php

namespace Database\Seeders;

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
        $categories = Category::pluck('id', 'name');

        $subcategories = [
            ['name' => 'Plumbing', 'category' => 'Home Services', 'description' => 'Fix leaks, install pipes, and more.'],
            ['name' => 'Electrical Repair', 'category' => 'Home Services','description' => 'Switches, sockets, lighting issues.'],
            ['name' => 'Math Tutoring', 'category' => 'Education',  'description' => 'Algebra, geometry, and exams.'],
            ['name' => 'Language Tutoring', 'category' => 'Education', 'description' => 'English, French, Arabic etc.'],
            ['name' => 'Hair Styling', 'category' => 'Beauty & Wellness','description' => 'Cuts, styling, and treatments.'],
            ['name' => 'Massage Therapy', 'category' => 'Beauty & Wellness',  'description' => 'Relaxation and therapeutic sessions.'],
            ['name' => 'Laptop Repair', 'category' => 'Tech Support', 'description' => 'Hardware fixes, OS installs.'],
            ['name' => 'Wi-Fi Setup', 'category' => 'Tech Support',  'description' => 'Network configuration and security.'],
            ['name' => 'Logo Design', 'category' => 'Design & Creative', 'description' => 'Brand visuals and identity.'],
            ['name' => 'Video Editing', 'category' => 'Design & Creative',  'description' => 'Trimming, effects, and reels.'],
            ['name' => 'Event Planning', 'category' => 'Events',  'description' => 'Full event coordination.'],
            ['name' => 'Balloon Decoration', 'category' => 'Events', 'description' => 'Festive designs for parties.'],
            ['name' => 'Car Wash', 'category' => 'Automotive', 'description' => 'Exterior/interior cleaning.'],
            ['name' => 'Oil Change', 'category' => 'Automotive',  'description' => 'Quick and clean oil service.'],
            ['name' => 'Notary Services', 'category' => 'Legal & Finance',  'description' => 'Document verification.'],
            ['name' => 'Tax Filing', 'category' => 'Legal & Finance', 'description' => 'Income statements and returns.'],
            ['name' => 'Nursing Care', 'category' => 'Healthcare',  'description' => 'In-home medical support.'],
            ['name' => 'Therapy Sessions', 'category' => 'Healthcare', 'description' => 'Mental health support.'],
            ['name' => 'House Cleaning', 'category' => 'Cleaning Services',  'description' => 'Basic daily cleaning routines.'],
            ['name' => 'Deep Cleaning', 'category' => 'Cleaning Services', 'description' => 'Sanitizing and corner-to-corner cleaning.'],
        ];

        foreach ($subcategories as $sub) {
            SubCategory::create([
                'name' => $sub['name'],
                'description' => $sub['description'],
                'status' => 'active',
                'category_id' => $categories[$sub['category']],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

}
