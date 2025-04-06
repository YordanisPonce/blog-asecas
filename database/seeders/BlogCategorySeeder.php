<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Penal',
            ],
            [
                'name' => 'Civil',
            ],
            [
                'name' => 'Contencioso',
            ],
            [
                'name' => 'Social',
            ],
            [
                'name' => 'De interés General',
            ],
            [
                'name' => 'Derecho penal',
            ],
            [
                'name' => 'Derecho civil',
            ],
            [
                'name' => 'Derecho contencioso',
            ],
        ];

        foreach ($categories as $category) {
            BlogCategory::create($category);
        }
    }
} 