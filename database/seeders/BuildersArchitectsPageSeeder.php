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

                'hero_description_es' => null,
                'hero_description_en' => null,
                'hero_description_fr' => null,

                // ✅ NUEVA IMAGEN HERO (según lo que me dijiste)
                'hero_image_url' => 'professionals/team-architects-looking-construction-site.jpg',

                'hero_image_title_es' => 'Constructores y arquitectos',
                'hero_image_title_en' => 'Builders and architects',
                'hero_image_title_fr' => 'Constructeurs et architectes',

                'hero_image_alt_es' => 'Equipo técnico en obra',
                'hero_image_alt_en' => 'Technical team on site',
                'hero_image_alt_fr' => 'Équipe technique sur chantier',

                // ---------------- COLUMNA 1 ----------------
                'col1_title_es' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Asesoramiento y soporte especializado</h3>',
                'col1_title_en' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Specialized advice and support</h3>',
                'col1_title_fr' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Conseil et support spécialisés</h3>',

                'col1_text_es' => '<p class="text-xl mb-4">Nuestro equipo especializado te facilitará las cotizaciones por partidas detalladas.</p>',
                'col1_text_en' => '<p class="text-xl mb-4">Our specialized team will provide detailed, itemized quotes.</p>',
                'col1_text_fr' => '<p class="text-xl mb-4">Notre équipe spécialisée vous fournira des devis détaillés par postes.</p>',

                'col1_bullets_es' => '<ul class="list-none space-y-2">
<li style="text-decoration:none" class="">- Equipo profesional de análisis y soporte.</li>
<li style="text-decoration:none" class="">- Asistencia en consultas, posibilidades de aplicación.</li>
<li style="text-decoration:none" class="">- Cotización por partidas.</li>
<li style="text-decoration:none" class="">- Recomendaciones de producto, acabado y colores.</li>
</ul>',
                'col1_bullets_en' => '<ul class="list-none space-y-2">
<li style="text-decoration:none" class="">- Professional analysis &amp; support team.</li>
<li style="text-decoration:none" class="">- Help with questions and application options.</li>
<li style="text-decoration:none" class="">- Itemized quoting.</li>
<li style="text-decoration:none" class="">- Product, finish and color recommendations.</li>
</ul>',
                'col1_bullets_fr' => '<ul class="list-none space-y-2">
<li style="text-decoration:none" class="">- Équipe professionnelle d’analyse et de support.</li>
<li style="text-decoration:none" class="">- Assistance et possibilités d’application.</li>
<li style="text-decoration:none" class="">- Devis par postes.</li>
<li style="text-decoration:none" class="">- Recommandations de produit, finition et couleurs.</li>
</ul>',

                // ---------------- COLUMNA 2 ----------------
                'col2_title_es' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Ayuda en la definición del proyecto</h3>',
                'col2_title_en' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Help defining the project</h3>',
                'col2_title_fr' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Aide à la définition du projet</h3>',

                'col2_text_es' => '<p class="text-xl mb-4">Nos comprometemos a proporcionarte apoyo y asesoramiento sobre transporte, manipulación, aplicación y mantenimiento.</p>',
                'col2_text_en' => '<p class="text-xl mb-4">We provide support and advice on transport, handling, application and maintenance.</p>',
                'col2_text_fr' => '<p class="text-xl mb-4">Nous vous accompagnons sur le transport, la manutention, l’application et la maintenance.</p>',

                'col2_bullets_es' => '<ul class="list-none space-y-2">
<li style="text-decoration:none" class="">- Atención personalizada y soluciones adaptadas a tus proyectos.</li>
<li style="text-decoration:none" class="">- Asesoramiento para aplicación y mantenimiento.</li>
<li style="text-decoration:none" class="">- Estudio individualizado del proyecto.</li>
<li style="text-decoration:none" class="">- Optimización en términos de ahorro y rendimiento.</li>
</ul>',
                'col2_bullets_en' => '<ul class="list-none space-y-2">
<li style="text-decoration:none" class="">- Personalized attention and tailored solutions.</li>
<li style="text-decoration:none" class="">- Advice for application and maintenance.</li>
<li style="text-decoration:none" class="">- Project-specific assessment.</li>
<li style="text-decoration:none" class="">- Optimization for savings and performance.</li>
</ul>',
                'col2_bullets_fr' => '<ul class="list-none space-y-2">
<li style="text-decoration:none" class="">- Attention personnalisée et solutions adaptées.</li>
<li style="text-decoration:none" class="">- Conseil pour l’application et la maintenance.</li>
<li style="text-decoration:none" class="">- Étude individualisée du projet.</li>
<li style="text-decoration:none" class="">- Optimisation en termes d’économies et de performance.</li>
</ul>',

                // ---------------- COLUMNA 3 ----------------
                'col3_title_es' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Recursos para los proyectos</h3>',
                'col3_title_en' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Resources for projects</h3>',
                'col3_title_fr' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Ressources pour les projets</h3>',

                'col3_text_es' => '<p class="text-xl mb-4">Disfrutarás de un servicio exclusivo para desarrollar tus proyectos, plasmar tu visión y mejorarla con los morteros o cementos más avanzados.</p>',
                'col3_text_en' => '<p class="text-xl mb-4">An exclusive service to develop your projects, bring your vision to life and enhance it with advanced mortars and cements.</p>',
                'col3_text_fr' => '<p class="text-xl mb-4">Un service exclusif pour développer vos projets, concrétiser votre vision et l’améliorer avec des mortiers et ciments avancés.</p>',

                'col3_bullets_es' => '<ul class="list-none space-y-2">
<li style="text-decoration:none" class="">- Muestras en 48 h. Recibe las muestras que necesites para tus proyectos.</li>
<li style="text-decoration:none" class="">- Servicio personalizado. Te recomendamos aplicadores para garantizar el mejor servicio y calidad.</li>
</ul>',
                'col3_bullets_en' => '<ul class="list-none space-y-2">
<li style="text-decoration:none" class="">- Samples in 48h. Get the samples you need for your projects.</li>
<li style="text-decoration:none" class="">- Personalized service. We recommend applicators to ensure the best service and quality.</li>
</ul>',
                'col3_bullets_fr' => '<ul class="list-none space-y-2">
<li style="text-decoration:none" class="">- Échantillons en 48h. Recevez les échantillons nécessaires pour vos projets.</li>
<li style="text-decoration:none" class="">- Service personnalisé. Nous recommandons des applicateurs pour garantir le meilleur service et la meilleure qualité.</li>
</ul>',

                // ---------------- BANNER ----------------
                // ✅ NUEVA IMAGEN BANNER (según lo que me dijiste)
                'banner_image_url' => 'professionals/engineer-designer-choosing-palette.jpg',

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

                'featured_categories' => [
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
