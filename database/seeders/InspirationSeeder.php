<?php

namespace Database\Seeders;

use App\Models\Inspiration;
use Illuminate\Database\Seeder;

class InspirationSeeder extends Seeder
{
    public function run(): void
    {
        Inspiration::updateOrCreate(
            ['image_path' => 'inspirations/demo-1.jpg'],
            [
                'title_es' => 'Caso real 1',
                'alt_es' => 'Fachada moderna',
                'position' => 1,
                'is_active' => true,
            ]
        );
    }
}
