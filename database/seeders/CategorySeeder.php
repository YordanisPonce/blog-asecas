<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'LIME MORTAR',
                'slug' => 'lime-mortar',
                'short_description_en' => 'Traditional lime mortar for restoration and eco-friendly constructions',
                'short_description_es' => 'Mortero de cal tradicional para restauración y construcciones ecológicas',
                'short_description_fr' => 'Mortier à la chaux traditionnel pour la restauration et les constructions écologiques',
                'description_en' => 'Lime mortar is a traditional mixture composed of lime, sand, and water. It is used in the restoration of historic buildings and eco-friendly constructions due to its breathable properties and ability to regulate humidity.',
                'description_es' => 'El mortero de cal es una mezcla tradicional compuesta de cal, arena y agua. Se utiliza en la restauración de edificios históricos y construcciones ecológicas debido a sus propiedades transpirables y capacidad para regular la humedad.',
                'description_fr' => 'Le mortier à la chaux est un mélange traditionnel composé de chaux, de sable et d\'eau. Il est utilisé dans la restauration de bâtiments historiques et les constructions écologiques en raison de ses propriétés respirantes et de sa capacité à réguler l\'humidité.',
                'image_alt' => [
                    'en' => 'Lime Mortar for construction and restoration',
                    'es' => 'Mortero de Cal para construcción y restauración',
                    'fr' => 'Mortier à la chaux pour construction et restauration'
                ],
                'image_title' => [
                    'en' => 'High Quality Lime Mortar',
                    'es' => 'Mortero de Cal de Alta Calidad',
                    'fr' => 'Mortier à la Chaux de Haute Qualité'
                ],
                'order' => 1,
            ],
            // Agrega más categorías aquí según tus imágenes...
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}