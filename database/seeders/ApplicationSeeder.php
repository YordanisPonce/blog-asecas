<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run()
    {
        $applications = [
            [
                'name' => 'Applications',
                'slug' => 'applications',
                'short_description_en' => 'Discover the various applications of our products',
                'short_description_es' => 'Descubre las diversas aplicaciones de nuestros productos',
                'short_description_fr' => 'Découvrez les diverses applications de nos produits',
                'description_en' => 'Explore the wide range of applications for our construction materials and coatings.',
                'description_es' => 'Explora la amplia gama de aplicaciones para nuestros materiales de construcción y revestimientos.',
                'description_fr' => 'Explorez la large gamme d\'applications pour nos matériaux de construction et revêtements.',
                'image_alt' => [
                    'en' => 'Construction product applications',
                    'es' => 'Aplicaciones de productos de construcción',
                    'fr' => 'Applications de produits de construction'
                ],
                'image_title' => [
                    'en' => 'Product Applications Overview',
                    'es' => 'Resumen de Aplicaciones de Productos',
                    'fr' => 'Aperçu des Applications de Produits'
                ],
                'order' => 1,
            ],
            [
                'name' => 'Spaces',
                'slug' => 'spaces',
                'short_description_en' => 'Ideal solutions for different spaces and environments',
                'short_description_es' => 'Soluciones ideales para diferentes espacios y entornos',
                'short_description_fr' => 'Solutions idéales pour différents espaces et environnements',
                'description_en' => 'Find the perfect solutions for various spaces including residential, commercial, and industrial environments.',
                'description_es' => 'Encuentra las soluciones perfectas para varios espacios incluyendo entornos residenciales, comerciales e industriales.',
                'description_fr' => 'Trouvez les solutions parfaites pour divers espaces incluant les environnements résidentiels, commerciaux et industriels.',
                'image_alt' => [
                    'en' => 'Construction spaces and environments',
                    'es' => 'Espacios y entornos de construcción',
                    'fr' => 'Espaces et environnements de construction'
                ],
                'image_title' => [
                    'en' => 'Space Solutions',
                    'es' => 'Soluciones para Espacios',
                    'fr' => 'Solutions pour Espaces'
                ],
                'order' => 2,
            ],
            // Agregar más aplicaciones según necesites
        ];

        // Obtener todas las categorías para asociarlas
        $categories = Category::all();

        foreach ($applications as $applicationData) {
            $application = Application::create($applicationData);
            
            // Asociar con todas las categorías (o puedes personalizar esta lógica)
            $application->categories()->attach($categories->pluck('id'));
        }
    }
}