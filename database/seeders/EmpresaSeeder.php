<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    public function run(): void
    {
        Empresa::updateOrCreate(
            ['id' => 1],
            [
                'hero_title_es' => '<h1 class="text-white text-2xl md:text-5xl font-[600] max-w-6xl mx-auto leading-tight">Más de 25 años en el sector de revestimientos de fachadas y cerámicos a nivel internacional.</h1>',
                'hero_title_en' => '<h1 class="text-white text-2xl md:text-5xl font-[600] max-w-6xl mx-auto leading-tight">More than 25 years in the facade cladding and ceramic sector internationally.</h1>',
                'hero_title_fr' => '<h1 class="text-white text-2xl md:text-5xl font-[600] max-w-6xl mx-auto leading-tight">Plus de 25 ans dans le secteur des revêtements de façades et de céramiques à linternational.</h1>',
                'hero_video_url' => 'https://uploads.innet.es/videos-estucalia/exterior.mp4',
                'hero_image' => 'empresa/hero.jpg',
                'hero_image_title' => 'Hero',
                'hero_image_alt' => 'Hero',

                'about_title_es' => '<h2 class="text-3xl font-[600] mb-2">Somos Grupo Estucalia</h2>',
                'about_title_en' => '<h2 class="text-3xl font-[600] mb-2">We are Grupo Estucalia</h2>',
                'about_title_fr' => '<h2 class="text-3xl font-[600] mb-2">Nous sommes le Groupe Estucalia</h2>',
                'about_text_es' => 'Grupo Estucalia está compuesto por varias empresas especializadas en fabricación, comercialización y exportación de morteros monocapa para el revestimiento de fachadas, y cementos cola y rejuntado para el revestimiento cerámico de suelos y paredes.',
                'about_text_en' => 'Grupo Estucalia is made up of several companies specialized in the manufacturing, marketing and export of monocapa mortars for façade coatings, and tile adhesives and grouts for ceramic flooring and wall coverings.',
                'about_text_fr' => 'Grupo Estucalia est composé de plusieurs entreprises spécialisées dans la fabrication, la commercialisation et l’exportation de mortiers monocouche pour le revêtement de façades, ainsi que de colles et joints pour le revêtement céramique des sols et des murs.',
                'about_illustration' => 'empresa/about.png',
                'about_illustration_title' => 'About',
                'about_illustration_alt' => 'About',

                'mission_title_es' => 'Nuestra misión',
                'mission_title_en' => 'Our mission',
                'mission_title_fr' => 'Notre mission',
                'mission_text_es' => 'En nuestra empresa, la misión es clara: proporcionar un servicio de calidad excepcional ofreciendo total disponibilidad del equipo para garantizar su satisfacción.',
                'mission_text_en' => 'Our mission is clear: to provide exceptional quality service with full team availability to ensure your satisfaction.',
                'mission_text_fr' => 'Notre mission est claire : offrir un service d’une qualité exceptionnelle, avec une disponibilité totale de l’équipe afin de garantir votre satisfaction.',

                'production_title_es' => '100.000 Tm/año',
                'production_title_en' => '100,000 Tm/year',
                'production_title_fr' => '100 000 Tm/an',
                'production_text_es' => 'Nuestras instalaciones, dotadas con la última tecnología en maquinaria, nos permiten obtener una producción diaria de 300 Tm.',
                'production_text_en' => 'Our facilities, equipped with the latest machinery technology, allow us to achieve a daily production of 300 Tm.',
                'production_text_fr' => 'Nos installations, dotées des dernières technologies en matière de machines, nous permettent d’atteindre une production quotidienne de 300 Tm.',
                'production_stat' => '100.000 Tm/año',
                'production_media_url' => null,
                'production_image' => 'empresa/production.jpg',
                'production_image_title' => 'Producción',
                'production_image_alt' => 'Producción',

                // segundo video
                'solutions_video_url' => 'https://uploads.innet.es/videos-estucalia/produccion.mp4',

                'solutions_title_es' => 'Soluciones de construcción',
                'solutions_title_en' => 'Construction solutions',
                'solutions_title_fr' => 'Solutions de construction',
                'solutions_intro_es' => 'Gracias a sus más de 25 años de experiencia Grupo Estucalia ofrece una gama de productos con una calidad excepcional.',
                'solutions_intro_en' => 'With more than 25 years of experience, Grupo Estucalia offers a range of products of exceptional quality.',
                'solutions_intro_fr' => 'Avec plus de 25 ans d’expérience, Grupo Estucalia propose une gamme de produits d’une qualité exceptionnelle.',


                // categorías destacadas (ejemplo)
                'featured_categories_items' => [
                    ['category_id' => 1],
                    ['category_id' => 2],
                ],

                'international_title_es' => 'Internacionales',
                'international_title_en' => 'International',
                'international_title_fr' => 'International',
                'international_text_es' => "Grupo Estucalia está presente en el extranjero, teniendo distribuidores y clientes en lugares como:\n\nArgelia,\nMarruecos,\nKuwait,\nArabia Saudí,\nEgipto,\nQatar,\nEmiratos,\nYemen...",
                'international_text_en' => "Grupo Estucalia is present abroad, with distributors and customers in places such as:\n\nAlgeria,\nMorocco,\nKuwait,\nSaudi Arabia,\nEgypt,\nQatar,\nUAE,\nYemen...",
                'international_text_fr' => "Grupo Estucalia est présent à l’étranger, avec des distributeurs et des clients dans des pays tels que :\n\nAlgérie,\nMaroc,\nKoweït,\nArabie Saoudite,\nÉgypte,\nQatar,\nÉmirats,\nYémen...",

                'international_image' => 'empresa/international.jpg',
                'international_image_title' => 'Internacionales',
                'international_image_alt' => 'Internacionales',

                'certs_title_es' => 'Resultados a la altura de las exigencias',
                'certs_title_en' => 'Results that meet the highest standards',
                'certs_title_fr' => "Des résultats à la hauteur des exigences",
                'international_text_es' => "Grupo Estucalia está presente en el extranjero, teniendo distribuidores y clientes en lugares como:\n\nArgelia,\nMarruecos,\nKuwait,\nArabia Saudí,\nEgipto,\nQatar,\nEmiratos,\nYemen...",
                'international_text_en' => "Grupo Estucalia is present abroad, with distributors and customers in places such as:\n\nAlgeria,\nMorocco,\nKuwait,\nSaudi Arabia,\nEgypt,\nQatar,\nUAE,\nYemen...",
                'international_text_fr' => "Grupo Estucalia est présent à l’étranger, avec des distributeurs et des clients dans des pays tels que :\n\nAlgérie,\nMaroc,\nKoweït,\nArabie Saoudite,\nÉgypte,\nQatar,\nÉmirats,\nYémen...",

                'certs_logos' => [
                    ['logo_url' => 'empresa/certs/ce.png', 'title' => 'CE', 'alt' => 'CE'],
                    ['logo_url' => 'empresa/certs/aenor.png', 'title' => 'AENOR', 'alt' => 'AENOR'],
                    ['logo_url' => 'empresa/certs/iqnet.png', 'title' => 'IQNet', 'alt' => 'IQNet'],
                    ['logo_url' => 'empresa/certs/other.png', 'title' => 'Other', 'alt' => 'Other'],
                ],

                'consulting_title_es' => 'Asesoramiento personalizado',
                'consulting_title_en' => 'Personalized advice',
                'consulting_title_fr' => 'Conseil personnalisé',
                'consulting_text_es' => 'La excelencia en el acabado de cada proyecto no es solo el último paso en nuestra búsqueda de calidad, sino el sello distintivo que define el resultado final. Grupo Estucalia pone a su disposición un equipo técnico preparado para proporcionar asistencia experta en cada proyecto que emprendamos juntos.',
                'consulting_text_en' => 'Excellence in the finish of every project is not only the final step in our pursuit of quality, but the hallmark that defines the final result. Grupo Estucalia provides a technical team ready to offer expert assistance in every project we undertake together.',
                'consulting_text_fr' => 'L’excellence dans la finition de chaque projet n’est pas seulement la dernière étape de notre quête de qualité, mais la signature qui définit le résultat final. Grupo Estucalia met à votre disposition une équipe technique prête à fournir une assistance experte pour chaque projet mené ensemble.',

                'consulting_cta_text_es' => 'Más información',
                'consulting_cta_text_en' => 'More info',
                'consulting_cta_text_fr' => "Plus d'infos",
                'consulting_cta_url' => '/contacto',
                'consulting_bg_image' => 'empresa/consulting.jpg',
                'consulting_bg_image_title' => 'Consultoría',
                'consulting_bg_image_alt' => 'Consultoría',

                'bottom_bg_image' => 'empresa/bottom.jpg',
                'bottom_bg_image_title' => 'Bottom',
                'bottom_bg_image_alt' => 'Bottom',
            ]
        );
    }
}
