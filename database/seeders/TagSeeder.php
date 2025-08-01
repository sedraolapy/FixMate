<?php

namespace Database\Seeders;

use App\Models\ServiceProvider;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = ['Reliable', 'Fast', 'Affordable', 'Experienced', 'Friendly'];

        foreach ($tags as $tagName) {
            Tag::create([
                'name' => $tagName,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $allTags = Tag::all();
        $providers = ServiceProvider::all();

        foreach ($providers as $provider) {
            $provider->tags()->attach(
                $allTags->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
