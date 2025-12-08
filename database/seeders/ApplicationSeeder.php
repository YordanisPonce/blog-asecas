<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $applications = [
            [
                'id' => 'coatings',
                'aplication' => 'applications.categories.coatings',
                'img' => '/img/revestimiento.jpg',
                'descripcion' => 'applications.descriptions.coatings',
            ],
            [
                'id' => 'plasters',
                'aplication' => 'applications.categories.plasters',
                'img' => '/img/revocos_enlucidos.jpg',
                'descripcion' => 'applications.descriptions.plasters',
            ],
            [
                'id' => 'masonry',
                'aplication' => 'applications.categories.masonry',
                'img' => '/img/albañileria.jpg',
                'descripcion' => 'applications.descriptions.masonry',
            ],
            [
                'id' => 'tiles',
                'aplication' => 'applications.categories.tiles',
                'img' => '/img/baldosas.jpg',
                'descripcion' => 'applications.descriptions.tiles',
            ],
            [
                'id' => 'thermalInsulation',
                'aplication' => 'applications.categories.thermal',
                'img' => '/img/aislamiento.jpg',
                'descripcion' => 'applications.descriptions.thermal',
            ],
            [
                'id' => 'waterproofing',
                'aplication' => 'applications.categories.waterproofing',
                'img' => '/img/impermeabilizacion.jpg',
                'descripcion' => 'applications.descriptions.waterproofing',
            ],
            [
                'id' => 'dehumidification',
                'aplication' => 'applications.categories.dehumidification',
                'img' => '/img/deshumificacion.jpg',
                'descripcion' => 'applications.descriptions.dehumidification',
            ],
        ];

        foreach ($applications as $index => $item) {
            // Generamos un nombre legible a partir del id
            // ej: "thermalInsulation" => "Thermal Insulation"
            $label = Str::headline($item['id']);

            Application::updateOrCreate(
                [
                    // criterio para encontrar la app si ya existe
                    'slug' => $item['id'],
                ],
                [
                    // campos mínimos para que tu Resource funcione
                    'name' => $label,
                    'slug' => $item['id'],

                    'name_en' => $label,
                    'slug_en' => $item['id'],

                    'name_fr' => $label,
                    'slug_fr' => $item['id'],

                    'image' => $item['img'],     // la URL tal cual, luego en el front la concatenas
                    'order' => $index + 1,
                    'is_active' => true,

                    // si te interesa guardar la key de descripción en español:
                    // ajusta el nombre de la columna si lo necesitas
                    'short_description_es' => $item['descripcion'],
                ]
            );
        }
    }
}
