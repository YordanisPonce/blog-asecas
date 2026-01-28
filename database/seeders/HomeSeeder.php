<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Home;

class HomeSeeder extends Seeder
{
    public function run(): void
    {
        Home::updateOrCreate(
            ['id' => 1],
            [
                'first_title_es' => 'Morteros sostenibles para la arquitectura y construcción.',
                'first_title_en' => 'Sustainable mortars for architecture and construction.',
                'first_title_fr' => 'Mortiers durables pour l’architecture et la construction.',

                'first_description_es' => null,
                'first_description_en' => null,
                'first_description_fr' => null,

                'first_image_url' => 'home/hero.jpg',

                'first_image_title_es' => 'Morteros sostenibles',
                'first_image_alt_es' => 'Fondo arquitectónico para sección hero',
                'first_image_title_en' => 'Sustainable mortars',
                'first_image_alt_en' => 'Architectural background for hero section',
                'first_image_title_fr' => 'Mortiers durables',
                'first_image_alt_fr' => 'Arrière-plan architectural pour la section hero',

                'second_title_es' => 'Grupo Estucalia',
                'second_title_en' => 'Estucalia Group',
                'second_title_fr' => 'Groupe Estucalia',

                'second_description_es' => 'Más de 25 años desarrollando y fabricando morteros de alta gama.',
                'second_description_en' => 'More than 25 years developing and manufacturing premium mortars.',
                'second_description_fr' => 'Plus de 25 ans à développer et fabriquer des mortiers haut de gamme.',

                'second_image_url' => null,

                'cta_help_title_es' => '¿Necesitas ayuda con tu proyecto?',
                'cta_help_title_en' => 'Need help with your project?',
                'cta_help_title_fr' => 'Besoin d’aide pour votre projet ?',

                'cta_help_text_es' => 'Nuestro equipo de expertos está listo para asesorarte en la selección de los productos más adecuados para tu proyecto. Contáctanos y te ayudaremos a encontrar la mejor solución.',
                'cta_help_text_en' => 'Our team of experts is ready to help you choose the most suitable products for your project. Contact us and we’ll help you find the best solution.',
                'cta_help_text_fr' => 'Notre équipe d’experts est prête à vous conseiller dans le choix des produits les plus adaptés à votre projet. Contactez-nous et nous vous aiderons à trouver la meilleure solution.',

                'cta_help_button_es' => 'Contactar',
                'cta_help_button_en' => 'Contact',
                'cta_help_button_fr' => 'Contacter',

                'cta_help_url' => '/contacto',
                'cta_help_image_url' => 'home/help-bg.jpg',

                'cta_help_image_title_es' => 'Asesoría para proyectos',
                'cta_help_image_alt_es' => 'Persona trabajando, imagen de fondo de la sección de ayuda',
                'cta_help_image_title_en' => 'Project assistance',
                'cta_help_image_alt_en' => 'Person working, background image for help section',
                'cta_help_image_title_fr' => 'Assistance de projet',
                'cta_help_image_alt_fr' => 'Personne travaillant, image de fond de la section aide',

                'seo_title_es' => 'Estucalia | Morteros sostenibles',
                'seo_description_es' => 'Morteros sostenibles para arquitectura y construcción. Más de 25 años desarrollando y fabricando morteros de alta gama.',
            ]
        );
    }
}
