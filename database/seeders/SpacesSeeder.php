<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Space;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpacesSeeder extends Seeder
{
    public function run(): void
    {
        // Mapeo de apps (usa slugs reales que tengas en DB)
        // Si tus slugs en DB son otros, ajusta aquí.
        $spaces = [
            [
                'slug' => 'facades',
                'title' => 'Fachadas',
                'title_en' => 'Facades',
                'title_fr' => 'Façades',
                'image' => '/img/espacios/fachadas.jpg',
                'description' => 'Soluciones para fachadas: revestimientos, morteros y protección.',
                'description_en' => 'Facade solutions: coatings, mortars and protection.',
                'description_fr' => 'Solutions pour façades : revêtements, mortiers et protection.',
                'applications' => ['coatings', 'plasters', 'masonry', 'thermal', 'waterproofing', 'dehumidification'],
            ],
            [
                'slug' => 'terraces',
                'title' => 'Terrazas',
                'title_en' => 'Terraces',
                'title_fr' => 'Terrasses',
                'image' => '/img/espacios/terrazas.jpg',
                'description' => 'Sistemas para terrazas: resistencia, impermeabilización y acabados.',
                'description_en' => 'Terrace systems: durability, waterproofing and finishes.',
                'description_fr' => 'Systèmes pour terrasses : durabilité, étanchéité et finitions.',
                'applications' => ['coatings', 'plasters', 'masonry', 'tiles', 'thermal', 'waterproofing', 'dehumidification'],
            ],
            [
                'slug' => 'balconies',
                'title' => 'Balcones',
                'title_en' => 'Balconies',
                'title_fr' => 'Balcons',
                'image' => '/img/espacios/balcones.jpg',
                'description' => 'Soluciones para balcones: protección y acabados exteriores.',
                'description_en' => 'Balcony solutions: protection and outdoor finishes.',
                'description_fr' => 'Solutions pour balcons : protection et finitions extérieures.',
                'applications' => ['coatings', 'plasters', 'masonry', 'thermal', 'waterproofing'],
            ],
            [
                'slug' => 'walls',
                'title' => 'Paredes',
                'title_en' => 'Walls',
                'title_fr' => 'Murs',
                'image' => '/img/espacios/paredes.jpg',
                'description' => 'Tratamientos para paredes: alisados, recubrimientos y humedad.',
                'description_en' => 'Wall treatments: smoothing, coatings and damp solutions.',
                'description_fr' => 'Traitements des murs : lissage, revêtements et humidité.',
                'applications' => ['coatings', 'plasters', 'masonry', 'tiles', 'waterproofing', 'dehumidification'],
            ],
            [
                'slug' => 'patios',
                'title' => 'Patios y lucernarios',
                'title_en' => 'Patios & Skylights',
                'title_fr' => 'Patios et puits de lumière',
                // ojo: en tu fake hay espacios en el nombre del archivo
                // mejor encodarlo para evitar problemas:
                'image' => '/img/espacios/patios%20y%20lucernarios.jpg',
                'description' => 'Sistemas para patios: durabilidad, juntas y protección al agua.',
                'description_en' => 'Patio systems: durability, joints and water protection.',
                'description_fr' => 'Systèmes pour patios : durabilité, joints et protection à l’eau.',
                'applications' => ['coatings', 'plasters', 'masonry', 'tiles', 'waterproofing', 'dehumidification'],
            ],
            [
                'slug' => 'floors',
                'title' => 'Pavimentos',
                'title_en' => 'Floors',
                'title_fr' => 'Sols',
                'image' => '/img/espacios/pavimentos.jpg',
                'description' => 'Soluciones para pavimentos: colocación y protección.',
                'description_en' => 'Floor solutions: installation and protection.',
                'description_fr' => 'Solutions pour sols : pose et protection.',
                'applications' => ['tiles', 'waterproofing'],
            ],
            [
                'slug' => 'kitchens',
                'title' => 'Cocina exterior',
                'title_en' => 'Outdoor Kitchen',
                'title_fr' => 'Cuisine extérieure',
                'image' => '/img/espacios/cocina%20exterior.jpg',
                'description' => 'Sistemas para cocina exterior: revestimientos, juntas y agua.',
                'description_en' => 'Outdoor kitchen systems: coatings, joints and water solutions.',
                'description_fr' => 'Systèmes pour cuisine extérieure : revêtements, joints et eau.',
                'applications' => ['coatings', 'plasters', 'masonry', 'tiles', 'waterproofing'],
            ],
            [
                'slug' => 'pools',
                'title' => 'Piscina',
                'title_en' => 'Pool',
                'title_fr' => 'Piscine',
                'image' => '/img/espacios/piscina.jpg',
                'description' => 'Soluciones para piscinas: construcción, colocación y sellado.',
                'description_en' => 'Pool solutions: construction, installation and sealing.',
                'description_fr' => 'Solutions pour piscines : construction, pose et étanchéité.',
                'applications' => ['masonry', 'tiles'],
            ],
        ];

        foreach ($spaces as $index => $row) {
            $slug = $row['slug'];

            $space = Space::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $row['title'],
                    'title_en' => $row['title_en'] ?? null,
                    'title_fr' => $row['title_fr'] ?? null,

                    // slugs EN/FR opcionales (puedes cambiarlos por los tuyos reales)
                    'slug_en' => $row['slug_en'] ?? $slug,
                    'slug_fr' => $row['slug_fr'] ?? $slug,

                    'description' => $row['description'] ?? null,
                    'description_en' => $row['description_en'] ?? null,
                    'description_fr' => $row['description_fr'] ?? null,

                    'image' => $row['image'] ?? null,

                    'image_title' => [
                        'es' => $row['title'] ?? '',
                        'en' => $row['title_en'] ?? ($row['title'] ?? ''),
                        'fr' => $row['title_fr'] ?? ($row['title'] ?? ''),
                    ],
                    'image_alt' => [
                        'es' => $row['title'] ?? '',
                        'en' => $row['title_en'] ?? ($row['title'] ?? ''),
                        'fr' => $row['title_fr'] ?? ($row['title'] ?? ''),
                    ],

                    'seo_title' => [
                        'es' => $row['title'] ?? '',
                        'en' => $row['title_en'] ?? ($row['title'] ?? ''),
                        'fr' => $row['title_fr'] ?? ($row['title'] ?? ''),
                    ],
                    'seo_description' => [
                        'es' => Str::limit($row['description'] ?? '', 160, ''),
                        'en' => Str::limit($row['description_en'] ?? ($row['description'] ?? ''), 160, ''),
                        'fr' => Str::limit($row['description_fr'] ?? ($row['description'] ?? ''), 160, ''),
                    ],

                    'order' => $index,
                    'is_active' => true,
                ]
            );

            // Vincular aplicaciones por pivot order
            $apps = $row['applications'] ?? [];

            // Limpia vínculos previos y vuelve a setear en el orden del seed
            // (si prefieres no borrar, dilo y lo hacemos updateOrCreate por app)
            $space->applicationLinks()->delete();

            foreach (array_values($apps) as $i => $appSlug) {
                $app = $this->findApplicationByAnySlug($appSlug);

                if (!$app) {
                    // Si no existe en DB, no rompe el seed, solo lo salta
                    continue;
                }

                $space->applicationLinks()->create([
                    'application_id' => $app->id,
                    'order' => $i,
                ]);
            }
        }
    }

    private function findApplicationByAnySlug(string $slug): ?Application
    {
        return Application::query()
            ->where('slug', $slug)
            ->orWhere('slug_en', $slug)
            ->orWhere('slug_fr', $slug)
            ->first();
    }
}
