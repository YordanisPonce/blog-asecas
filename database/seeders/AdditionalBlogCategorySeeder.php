<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class AdditionalBlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Digital',
            ],
            [
                'name' => 'Actualidad',
            ],
            [
                'name' => 'Entrevistas',
            ],
        ];

        foreach ($categories as $category) {
            // Check if category already exists to avoid duplicates
            if (!BlogCategory::where('name', $category['name'])->exists()) {
                BlogCategory::create($category);
            }
        }
    }
} 