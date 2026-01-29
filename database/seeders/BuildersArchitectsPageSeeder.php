<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BuildersArchitectsPage;

class BuildersArchitectsPageSeeder extends Seeder
{
    public function run(): void
    {
        BuildersArchitectsPage::updateOrCreate(
            ['id' => 1],
            [
                // ---------------- HERO ----------------
                'hero_title_es' => '¿Qué ofrece <span style="color:#d32f2f;">Grupo Estucalia</span> a constructores y arquitectos?',
                'hero_title_en' => 'What does <span style="color:#d32f2f;">Grupo Estucalia</span> offer to builders and architects?',
                'hero_title_fr' => 'Que propose <span style="color:#d32f2f;">Grupo Estucalia</span> aux constructeurs et architectes ?',

                // OJO: esto es lo que te faltaba (si el front lo usa)
                'hero_description_es' => null,
                'hero_description_en' => null,
                'hero_description_fr' => null,

                'hero_image_url' => 'professionals/constructores-hero.jpg',
                // OJO: esto es lo otro que te faltaba
                'hero_image_title_es' => 'Constructores y arquitectos',
                'hero_image_title_en' => 'Builders and architects',
                'hero_image_title_fr' => 'Constructeurs et architectes',

                'hero_image_alt_es' => 'Equipo técnico en obra',
                'hero_image_alt_en' => 'Technical team on site',
                'hero_image_alt_fr' => 'Équipe technique sur chantier',

                // ---------------- COLUMNA 1 ----------------
                'col1_title_es' => 'Asesoramiento y soporte especializado',
                'col1_title_en' => 'Specialized advice and support',
                'col1_title_fr' => 'Conseil et support spécialisés',

                'col1_text_es' => 'Nuestro equipo especializado te facilitará las cotizaciones por partidas detalladas.',
                'col1_text_en' => 'Our specialized team will provide detailed, itemized quotes.',
                'col1_text_fr' => 'Notre équipe spécialisée vous fournira des devis détaillés par postes.',

                'col1_bullets_es' => "- Equipo profesional de análisis y soporte.\n- Asistencia en consultas, posibilidades de aplicación.\n- Cotización por partidas.\n- Recomendaciones de producto, acabado y colores.",
                'col1_bullets_en' => "- Professional analysis & support team.\n- Help with questions and application options.\n- Itemized quoting.\n- Product, finish and color recommendations.",
                'col1_bullets_fr' => "- Équipe professionnelle d’analyse et de support.\n- Assistance et possibilités d’application.\n- Devis par postes.\n- Recommandations de produit, finition et couleurs.",

                // ---------------- COLUMNA 2 ----------------
                'col2_title_es' => 'Ayuda en la definición del proyecto',
                'col2_title_en' => 'Help defining the project',
                'col2_title_fr' => 'Aide à la définition du projet',

                'col2_text_es' => 'Nos comprometemos a proporcionarte apoyo y asesoramiento sobre transporte, manipulación, aplicación y mantenimiento.',
                'col2_text_en' => 'We provide support and advice on transport, handling, application and maintenance.',
                'col2_text_fr' => 'Nous vous accompagnons sur le transport, la manutention, l’application et la maintenance.',

                'col2_bullets_es' => "- Atención personalizada y soluciones adaptadas a tus proyectos.\n- Asesoramiento para aplicación y mantenimiento.\n- Estudio individualizado del proyecto.\n- Optimización en términos de ahorro y rendimiento.",
                'col2_bullets_en' => "- Personalized attention and tailored solutions.\n- Advice for application and maintenance.\n- Project-specific assessment.\n- Optimization for savings and performance.",
                'col2_bullets_fr' => "- Attention personnalisée et solutions adaptées.\n- Conseil pour l’application et la maintenance.\n- Étude individualisée du projet.\n- Optimisation en termes d’économies et de performance.",

                // ---------------- COLUMNA 3 ----------------
                'col3_title_es' => 'Recursos para los proyectos',
                'col3_title_en' => 'Resources for projects',
                'col3_title_fr' => 'Ressources pour les projets',

                'col3_text_es' => 'Disfrutarás de un servicio exclusivo para desarrollar tus proyectos, plasmar tu visión y mejorarla con los morteros o cementos más avanzados.',
                'col3_text_en' => 'An exclusive service to develop your projects, bring your vision to life and enhance it with advanced mortars and cements.',
                'col3_text_fr' => 'Un service exclusif pour développer vos projets, concrétiser votre vision et l’améliorer avec des mortiers et ciments avancés.',

                'col3_bullets_es' => "- Muestras en 48 h. Recibe las muestras que necesites para tus proyectos.\n- Servicio personalizado. Te recomendamos aplicadores para garantizar el mejor servicio y calidad.",
                'col3_bullets_en' => "- Samples in 48h. Get the samples you need.\n- Personalized service. We recommend applicators to ensure the best service and quality.",
                'col3_bullets_fr' => "- Échantillons en 48h. Recevez les échantillons nécessaires.\n- Service personnalisé. Nous recommandons des applicateurs pour garantir le meilleur service et la meilleure qualité.",

                // ---------------- BANNER ----------------
                'banner_image_url' => 'professionals/constructores-banner.jpg',
                // También te faltaba title aquí
                'banner_image_title_es' => 'Planos del proyecto',
                'banner_image_title_en' => 'Project plans',
                'banner_image_title_fr' => 'Plans du projet',

                'banner_image_alt_es' => 'Planos y diseños',
                'banner_image_alt_en' => 'Plans and designs',
                'banner_image_alt_fr' => 'Plans et designs',

                // ---------------- BLOQUE FINAL + PRODUCTOS ----------------
                'final_title_es' => 'Soluciones para la construcción',
                'final_title_en' => 'Construction solutions',
                'final_title_fr' => 'Solutions pour la construction',

                'final_description_es' => 'Gracias a sus más de 25 años de experiencia, Grupo Estucalia ofrece una gama de productos con una calidad excepcional.',
                'final_description_en' => 'With over 25 years of experience, Grupo Estucalia offers a range of products with exceptional quality.',
                'final_description_fr' => 'Grâce à plus de 25 ans d’expérience, Grupo Estucalia propose une gamme de produits d’une qualité exceptionnelle.',

                'featured_categories' => [],

                // ---------------- SEO ----------------
                'seo_title_es' => 'Constructores y Arquitectos | Estucalia',
                'seo_title_en' => 'Builders & Architects | Estucalia',
                'seo_title_fr' => 'Constructeurs & Architectes | Estucalia',

                'seo_description_es' => 'Soluciones, soporte y recursos para constructores y arquitectos.',
                'seo_description_en' => 'Solutions, support and resources for builders and architects.',
                'seo_description_fr' => 'Solutions, support et ressources pour les constructeurs et architectes.',
            ]
        );
    }
}
