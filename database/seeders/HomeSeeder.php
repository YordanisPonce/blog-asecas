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
                'first_title_es' => '<h1 class="text-white text-3xl text-center font-[600] md:text-4xl xl:text-5xl max-w-3xl leading-tight mt-8 md:mt-0">Morteros sostenibles para la arquitectura y construcción.</h1>',
                'first_title_en' => '<h1 class="text-white text-3xl text-center font-[600] md:text-4xl xl:text-5xl max-w-3xl leading-tight mt-8 md:mt-0">Sustainable mortars for architecture and construction.</h1>',
                'first_title_fr' => '<h1 class="text-white text-3xl text-center font-[600] md:text-4xl xl:text-5xl max-w-3xl leading-tight mt-8 md:mt-0">Mortiers durables pour l’architecture et la construction.</h1>',

                'first_description_es' => null,
                'first_description_en' => null,
                'first_description_fr' => null,

                'first_image_url' => 'home/Home.jpg',

                'first_image_title_es' => 'Morteros sostenibles',
                'first_image_alt_es' => 'Fondo arquitectónico para sección hero',
                'first_image_title_en' => 'Sustainable mortars',
                'first_image_alt_en' => 'Architectural background for hero section',
                'first_image_title_fr' => 'Mortiers durables',
                'first_image_alt_fr' => 'Arrière-plan architectural pour la section hero',

                'second_title_es' => '<h2 class="text-2xl font-medium mb-4">Grupo Estucalia</h2>',
                'second_title_en' => '<h2 class="text-2xl font-medium mb-4">Estucalia Group</h2>',
                'second_title_fr' => '<h2 class="text-2xl font-medium mb-4">Groupe Estucalia</h2>',

                'second_description_es' => '<p class="text-3xl font-[600] text-gray-800 max-w-2xl mx-auto">Más de 25 años desarrollando y fabricando morteros de alta gama.</p>',
                'second_description_en' => '<p class="text-3xl font-[600] text-gray-800 max-w-2xl mx-auto">More than 25 years developing and manufacturing premium mortars.</p>',
                'second_description_fr' => '<p class="text-3xl font-[600] text-gray-800 max-w-2xl mx-auto">Plus de 25 ans à développer et fabriquer des mortiers haut de gamme.</p>',

                'second_image_url' => null,

                'cta_help_title_es' => '<h2 class="text-2xl md:text-3xl xl:text-4xl font-[600] mb-4">¿Necesitas ayuda con tu proyecto?</h2>',
                'cta_help_title_en' => '<h2 class="text-2xl md:text-3xl xl:text-4xl font-[600] mb-4">Need help with your project?</h2>',
                'cta_help_title_fr' => '<h2 class="text-2xl md:text-3xl xl:text-4xl font-[600] mb-4">Besoin d’aide pour votre projet ?</h2>',

                'cta_help_text_es' => '<p class="text-black text-base md:text-xl mb-8 text-left">Nuestro equipo de expertos está listo para asesorarte en la selección de los productos más adecuados para tu proyecto. Contáctanos y te ayudaremos a encontrar la mejor solución.</p>',
                'cta_help_text_en' => '<p class="text-black text-base md:text-xl mb-8 text-left">Our team of experts is ready to help you choose the most suitable products for your project. Contact us and we’ll help you find the best solution.</p>',
                'cta_help_text_fr' => '<p class="text-black text-base md:text-xl mb-8 text-left">Notre équipe d’experts est prête à vous conseiller dans le choix des produits les plus adaptés à votre projet. Contactez-nous et nous vous aiderons à trouver la meilleure solution.</p>',

                'cta_help_image_url' => 'home/helper.jpg',


                'cta_help_button_es' => 'Contactar',
                'cta_help_button_en' => 'Contact',
                'cta_help_button_fr' => 'Contacter',

                'cta_help_url' => '/contacto',

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
