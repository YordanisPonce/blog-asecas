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
                'about_illustration' => 'empresa/about/creatividad-img.png',
                'about_illustration_title' => 'About',
                'about_illustration_alt' => 'About',

                'mission_title_es' => '<h3 class="text-3xl font-[600] mb-6">Nuestra misión: satisfacer al cliente</h3>',
                'mission_title_en' => '<h3 class="text-3xl font-[600] mb-6">Our mission: customer satisfaction</h3>',
                'mission_title_fr' => '<h3 class="text-3xl font-[600] mb-6">Notre mission : satisfaire le client</h3>',
                'mission_text_es' => '<p class="text-lg max-w-2xl mx-auto">En nuestra empresa, la misión es clara: proporcionar un servicio de calidad excepcional ofreciendo total disponibilidad del equipo para garantizar su satisfacción.</p>',
                'mission_text_en' => '<p class="text-lg max-w-2xl mx-auto">In our company, the mission is clear: to provide exceptional quality service by offering full team availability to ensure your satisfaction.</p>',
                'mission_text_fr' => '<p class="text-lg max-w-2xl mx-auto">Dans notre entreprise, la mission est claire : fournir un service de qualité exceptionnelle avec une disponibilité totale de l’équipe pour garantir votre satisfaction.</p>',

                'production_title_es' => '<h2 class="text-4xl font-[600] mb-8">100.000 Tm/año</h2>',
                'production_title_en' => '<h2 class="text-4xl font-[600] mb-8">100.000 tons/year</h2>',
                'production_title_fr' => '<h2 class="text-4xl font-[600] mb-8">100 000 T/an</h2>',
                'production_text_es' => '<p class="text-xl max-w-3xl mx-auto">Nuestras instalaciones, dotadas con la última tecnología en maquinaria, nos permiten obtener una producción diaria de 300 Tm.</p>',
                'production_text_en' => '<p class="text-xl max-w-3xl mx-auto">Our facilities, equipped with the latest technology in machinery, allow us to obtain a daily production of 300 tons.</p>',
                'production_text_fr' => '<p class="text-xl max-w-3xl mx-auto">Nos installations, équipées des dernières technologies en machines, nous permettent une production quotidienne de 300 tonnes.</p>',
                'production_stat' => '100.000 Tm/año',
                'production_media_url' => null,
                'production_image' => 'empresa/production.jpg',
                'production_image_title' => 'Producción',
                'production_image_alt' => 'Producción',

                // segundo video
                'solutions_video_url' => 'https://uploads.innet.es/videos-estucalia/produccion.mp4',

                'solutions_title_es' => '<h2 class="text-3xl font-[600] mb-6">Soluciones de construcción</h2>',
                'solutions_title_en' => '<h2 class="text-3xl font-[600] mb-6">Construction Solutions</h2>',
                'solutions_title_fr' => '<h2 class="text-3xl font-[600] mb-6">Solutions pour la construction</h2>',

                'solutions_intro_es' => '<p class="text-lg max-w-4xl mx-auto">Gracias a sus más de 25 años de experiencia Grupo Estucalia ofrece una gama de productos con una calidad excepcional.</p>',
                'solutions_intro_en' => '<p class="text-lg max-w-4xl mx-auto">With more than 25 years of experience, Grupo Estucalia offers a range of products of exceptional quality.</p>',
                'solutions_intro_fr' => '<p class="text-lg max-w-4xl mx-auto">Fort de plus de 25 ans d’expérience, le Groupe Estucalia propose une gamme de produits d’une qualité exceptionnelle.</p>',




                'featured_categories_items' => [
                    'single-layer-mortar',      // Mortero monocapa
                    'tile-adhesive',            // Mortero cola
                    'lime-mortar',              // Mortero cal
                    'grout-mortar',             // Mortero juntas
                    'stamped-mortar',           // Mortero impreso
                    'decorative-stone-mortar',  // Mortero piedra decorativa
                    'water-protector',          // Protector de agua
                    'bonding-bridge',           // Puente de unión
                    'talisman-tools',           // Complementos y accesorios
                ],



                'international_title_es' => '<h2 class="text-4xl font-light  mb-4">Internacionales</h2>',
                'international_title_en' => '<h2 class="text-4xl font-light  mb-4">International</h2>',
                'international_title_fr' => '<h2 class="text-4xl font-light  mb-4">International</h2>',
                'international_text_es' => "Grupo Estucalia está presente en el extranjero, teniendo distribuidores y clientes en lugares como:\n\nArgelia,\nMarruecos,\nKuwait,\nArabia Saudí,\nEgipto,\nQatar,\nEmiratos,\nYemen...",
                'international_text_en' => "Grupo Estucalia is present abroad, with distributors and customers in places such as:\n\nAlgeria,\nMorocco,\nKuwait,\nSaudi Arabia,\nEgypt,\nQatar,\nUAE,\nYemen...",
                'international_text_fr' => "Grupo Estucalia est présent à l’étranger, avec des distributeurs et des clients dans des pays tels que :\n\nAlgérie,\nMaroc,\nKoweït,\nArabie Saoudite,\nÉgypte,\nQatar,\nÉmirats,\nYémen...",

                'international_image' => 'empresa/international/internacionales.jpg',
                'international_image_title' => 'Internacionales',
                'international_image_alt' => 'Internacionales',

                'certs_title_es' => '<h2 class="text-3xl font-[600] mb-8">Resultados a la altura de las exigencias</h2>',
                'certs_title_en' => '<h2 class="text-3xl font-[600] mb-8">Results that meet the highest standards</h2>',
                'certs_title_fr' => '<h2 class="text-3xl font-[600] mb-8">Des résultats à la hauteur des exigences</h2>',


                'certs_text_es' => "<p class='text-lg mb-16 leading-relaxed'>Nuestra empresa está comprometida con la calidad en cada paso del camino, como lo demuestra nuestra certificación de calidad. Grupo Estucalia integra el riguroso sistema de Calidad Total basado en la norma UNE-EN ISO 9001/2000 y certificado por AENOR como empresa registrada numero ER-0339/2002.</p>",
                'certs_text_en' => "<p class='text-lg mb-16 leading-relaxed'>Our company is committed to quality at every step of the way, as demonstrated by our quality certification. Grupo Estucalia integrates the rigorous Total Quality system based on the UNE-EN ISO 9001/2000 standard and certified by AENOR as company number ER-0339/2002.</p>",
                'certs_text_fr' => "<p class='text-lg mb-16 leading-relaxed'>Notre entreprise s'engage à la qualité à chaque étape du processus, comme le démontre notre certification qualité. Grupo Estucalia intègre le système rigoureux de Qualité Totale basé sur la norme UNE-EN ISO 9001/2000 et certifié par AENOR comme entreprise numéro ER-0339/2002.</p>",

                'certs_logos' => [
                    ['logo_url' => 'empresa/certs/ce.png', 'title' => 'CE', 'alt' => 'CE'],
                    ['logo_url' => 'empresa/certs/aenor.png', 'title' => 'AENOR', 'alt' => 'AENOR'],
                    ['logo_url' => 'empresa/certs/iqnet.png', 'title' => 'IQNet', 'alt' => 'IQNet'],
                    ['logo_url' => 'empresa/certs/other.png', 'title' => 'Other', 'alt' => 'Other'],
                ],

                'consulting_title_es' => '<h2 class="text-4xl font-[600] mb-8">Asesoramiento personalizado</h2>',
                'consulting_title_en' => '<h2 class="text-4xl font-[600] mb-8">Personalized advice</h2>',
                'consulting_title_fr' => '<h2 class="text-4xl font-[600] mb-8">Conseil personnalisé</h2>',
                'consulting_text_es' => '<p class="text-xl mb-12 leading-relaxed">La excelencia en el acabado de cada proyecto no es solo el último paso en nuestra búsqueda de calidad, sino el sello distintivo que define el resultado final. Grupo Estucalia pone a su disposición un equipo técnico preparado para proporcionar asistencia experta en cada proyecto que emprendamos juntos.</p>',
                'consulting_text_en' => '<p class="text-xl mb-12 leading-relaxed">Excellence in the finish of every project is not only the final step in our pursuit of quality, but the hallmark that defines the final result. Grupo Estucalia provides a technical team ready to offer expert assistance in every project we undertake together.</p>',
                'consulting_text_fr' => '<p class="text-xl mb-12 leading-relaxed">L’excellence dans la finition de chaque projet n’est pas seulement la dernière étape de notre quête de qualité, mais la signature qui définit le résultat final. Grupo Estucalia met à votre disposition une équipe technique prête à fournir une assistance experte pour chaque projet mené ensemble.</p>',

                'consulting_cta_text_es' => 'Más información',
                'consulting_cta_text_en' => 'More info',
                'consulting_cta_text_fr' => "Plus d'infos",
                'consulting_cta_url' => '/contacto',
                'consulting_bg_image' => 'empresa/consulting/asesoramiento.jpg',
                'consulting_bg_image_title' => 'Consultoría',
                'consulting_bg_image_alt' => 'Consultoría',

                'bottom_bg_image' => 'empresa/bottom/bg-down.png',
                'bottom_bg_image_title' => 'Bottom',
                'bottom_bg_image_alt' => 'Bottom',
            ]
        );
    }
}
