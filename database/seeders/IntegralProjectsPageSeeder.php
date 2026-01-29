<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IntegralProjectsPage;

class IntegralProjectsPageSeeder extends Seeder
{
    public function run(): void
    {
        IntegralProjectsPage::updateOrCreate(
            ['id' => 1],
            [
                // ---------------- HERO ----------------
                'hero_title_es' => 'Servicio Integral de Proyectos',
                'hero_title_en' => 'Comprehensive Project Service',
                'hero_title_fr' => 'Service intégral de projets',

                'hero_description_es' => null,
                'hero_description_en' => null,
                'hero_description_fr' => null,

                'hero_image_url' => 'professionals/servicio-integral-proyectos-hero.jpg',
                'hero_image_title_es' => 'Servicio Integral de Proyectos',
                'hero_image_title_en' => 'Comprehensive Project Service',
                'hero_image_title_fr' => 'Service intégral de projets',

                'hero_image_alt_es' => 'Servicio integral de proyectos',
                'hero_image_alt_en' => 'Comprehensive project service',
                'hero_image_alt_fr' => 'Service intégral de projets',

                // ---------------- 3 COLUMNAS ----------------
                // Col 1
                'col1_title_es' => 'Asesoramiento y soporte especializado',
                'col1_title_en' => 'Specialized advice and support',
                'col1_title_fr' => 'Conseil et support spécialisés',

                'col1_text_es' => 'Nuestro equipo especializado te facilitará las cotizaciones por partidas detalladas.',
                'col1_text_en' => 'Our specialized team will provide detailed, itemized quotes.',
                'col1_text_fr' => 'Notre équipe spécialisée vous fournira des devis détaillés par postes.',

                'col1_bullets_es' => null,
                'col1_bullets_en' => null,
                'col1_bullets_fr' => null,

                // Col 2
                'col2_title_es' => 'Ayuda en la definición del proyecto',
                'col2_title_en' => 'Help defining the project',
                'col2_title_fr' => 'Aide à la définition du projet',

                'col2_text_es' => 'Nos comprometemos a proporcionarte apoyo y asesoramiento sobre transporte, manipulación, aplicación y mantenimiento.',
                'col2_text_en' => 'We provide support and advice on transport, handling, application and maintenance.',
                'col2_text_fr' => 'Nous vous accompagnons sur le transport, la manutention, l’application et la maintenance.',

                'col2_bullets_es' => null,
                'col2_bullets_en' => null,
                'col2_bullets_fr' => null,

                // Col 3
                'col3_title_es' => 'Recursos para los proyectos',
                'col3_title_en' => 'Resources for projects',
                'col3_title_fr' => 'Ressources pour les projets',

                'col3_text_es' => 'Disfrutarás de un servicio exclusivo para desarrollar tus proyectos, plasmar tu visión y mejorarla con los morteros o cementos más avanzados.',
                'col3_text_en' => 'An exclusive service to develop your projects, bring your vision to life and enhance it with advanced mortars and cements.',
                'col3_text_fr' => 'Un service exclusif pour développer vos projets, concrétiser votre vision et l’améliorer avec des mortiers et ciments avancés.',

                'col3_bullets_es' => null,
                'col3_bullets_en' => null,
                'col3_bullets_fr' => null,


                'cards' => [
                    [
                        'title_es' => 'Asesoramiento y soporte especializado',
                        'text_es'  => 'Nuestro equipo especializado te facilitará las cotizaciones por partidas detalladas.',
                        'title_en' => 'Specialized advice and support',
                        'text_en'  => 'Our specialized team will provide detailed, itemized quotes.',
                        'title_fr' => 'Conseil et support spécialisés',
                        'text_fr'  => 'Notre équipe spécialisée vous fournira des devis détaillés par postes.',
                    ],
                    [
                        'title_es' => 'Ayuda en la definición del proyecto',
                        'text_es'  => 'Nos comprometemos a proporcionarte apoyo y asesoramiento sobre transporte, manipulación, aplicación y mantenimiento.',
                        'title_en' => 'Help defining the project',
                        'text_en'  => 'We provide support and advice on transport, handling, application and maintenance.',
                        'title_fr' => 'Aide à la définition du projet',
                        'text_fr'  => 'Nous vous accompagnons sur le transport, la manutention, l’application et la maintenance.',
                    ],
                    [
                        'title_es' => 'Recursos para los proyectos',
                        'text_es'  => 'Disfrutarás de un servicio exclusivo para poder desarrollar tus proyectos, plasmar tu visión y mejorarla con los morteros o cementos más avanzados.',
                        'title_en' => 'Resources for projects',
                        'text_en'  => 'An exclusive service to develop your projects, bring your vision to life and enhance it with advanced mortars and cements.',
                        'title_fr' => 'Ressources pour les projets',
                        'text_fr'  => 'Un service exclusif pour développer vos projets, concrétiser votre vision et l’améliorer avec des mortiers et ciments avancés.',
                    ],
                    [
                        'title_es' => 'Asistencia y soporte',
                        'text_es'  => "Nuestros especialistas están a tu disposición para ayudarte a nivel comercial y en materia de seguridad.\nAsesoramos sobre transporte, manipulación, aplicación y mantenimiento.",
                        'title_en' => 'Assistance and support',
                        'text_en'  => "Our specialists are available to support you commercially and on safety matters.\nWe advise on transport, handling, application and maintenance.",
                        'title_fr' => 'Assistance et support',
                        'text_fr'  => "Nos spécialistes sont à votre disposition pour vous accompagner sur les aspects commerciaux et de sécurité.\nConseils sur le transport, la manutention, l’application et la maintenance.",
                    ],
                    [
                        'title_es' => 'Servicio de entrega mundial',
                        'text_es'  => 'Disfruta de un servicio de entrega de alcance mundial para hacer crecer tu proyecto.',
                        'title_en' => 'Worldwide delivery service',
                        'text_en'  => 'Enjoy worldwide delivery to help your project grow.',
                        'title_fr' => 'Service de livraison mondial',
                        'text_fr'  => 'Profitez d’un service de livraison mondial pour développer votre projet.',
                    ],
                    [
                        'title_es' => 'Sostenibilidad y eficiencia',
                        'text_es'  => "Te ayudamos a conocer nuestro catálogo de productos,\nsus procesos de fabricación sostenibles y su diversidad de aplicaciones/usos.",
                        'title_en' => 'Sustainability and efficiency',
                        'text_en'  => "We help you explore our product catalogue,\nour sustainable manufacturing processes and the variety of applications/uses.",
                        'title_fr' => 'Durabilité et efficacité',
                        'text_fr'  => "Nous vous aidons à découvrir notre catalogue de produits,\nnos procédés de fabrication durables et la diversité des applications/usages.",
                    ],
                ],


                // ---------------- BANNER ----------------
                'banner_image_url' => 'professionals/servicio-integral-proyectos-banner.jpg',
                'banner_image_title_es' => 'Servicio Integral de Proyectos',
                'banner_image_title_en' => 'Comprehensive Project Service',
                'banner_image_title_fr' => 'Service intégral de projets',

                'banner_image_alt_es' => 'Imagen de proyecto',
                'banner_image_alt_en' => 'Project image',
                'banner_image_alt_fr' => 'Image de projet',

                // ---------------- SEO ----------------
                'seo_title_es' => 'Servicio Integral de Proyectos | Estucalia',
                'seo_title_en' => 'Comprehensive Project Service | Estucalia',
                'seo_title_fr' => 'Service intégral de projets | Estucalia',

                'seo_description_es' => 'Asesoramiento, definición y recursos para impulsar tus proyectos con soluciones técnicas y soporte especializado.',
                'seo_description_en' => 'Advice, project definition and resources to boost your projects with technical solutions and specialized support.',
                'seo_description_fr' => 'Conseil, définition et ressources pour développer vos projets avec des solutions techniques et un support spécialisé.',
            ]
        );
    }
}
