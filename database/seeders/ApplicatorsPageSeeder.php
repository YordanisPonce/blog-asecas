<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApplicatorsPage;

class ApplicatorsPageSeeder extends Seeder
{
    public function run(): void
    {
        ApplicatorsPage::updateOrCreate(
            ['id' => 1],
            [
                // ================= HERO =================
                'hero_title_es' => '¿Qué ofrece <span style="color:#d32f2f;">Grupo Estucalia</span> a los aplicadores?',
                'hero_title_en' => 'What does <span style="color:#d32f2f;">Grupo Estucalia</span> offer to applicators?',
                'hero_title_fr' => 'Que propose <span style="color:#d32f2f;">Grupo Estucalia</span> aux applicateurs ?',

                // Si tu tabla tiene estos campos, déjalos sembrados también
                'hero_description_es' => null,
                'hero_description_en' => null,
                'hero_description_fr' => null,

                'hero_image_url' => 'professionals/aplicadores-hero.jpg',

                // Si tu tabla tiene hero_image_title_*, sembrarlo también
                'hero_image_title_es' => 'Aplicadores',
                'hero_image_title_en' => 'Applicators',
                'hero_image_title_fr' => 'Applicateurs',

                'hero_image_alt_es' => 'Aplicadores trabajando',
                'hero_image_alt_en' => 'Applicators working',
                'hero_image_alt_fr' => 'Applicateurs au travail',

                // ================== 3 BLOQUES (COLUMNA 1/2/3) ==================
                'col1_title_es' => 'Asistencia y soporte',
                'col1_text_es'  => "Nuestros especialistas están a tu disposición para ayudarte a nivel comercial y en materia de seguridad.\nAsesoramos sobre transporte, manipulación, aplicación y mantenimiento.",
                'col1_bullets_es' => null,

                'col1_title_en' => 'Assistance and support',
                'col1_text_en'  => "Our specialists are at your disposal to support you commercially and in safety matters.\nWe advise on transport, handling, application and maintenance.",
                'col1_bullets_en' => null,

                'col1_title_fr' => 'Assistance et support',
                'col1_text_fr'  => "Nos spécialistes sont à votre disposition pour vous aider sur le plan commercial et en matière de sécurité.\nNous conseillons sur le transport, la manutention, l’application et la maintenance.",
                'col1_bullets_fr' => null,


                'col2_title_es' => 'Servicio de entrega mundial',
                'col2_text_es'  => 'Disfruta de un servicio de entrega de alcance mundial para hacer crecer tu proyecto.',
                'col2_bullets_es' => null,

                'col2_title_en' => 'Worldwide delivery service',
                'col2_text_en'  => 'Enjoy a worldwide delivery service to help your project grow.',
                'col2_bullets_en' => null,

                'col2_title_fr' => 'Service de livraison mondial',
                'col2_text_fr'  => 'Profitez d’un service de livraison à l’échelle mondiale pour développer votre projet.',
                'col2_bullets_fr' => null,


                'col3_title_es' => 'Sostenibilidad y eficiencia',
                'col3_text_es'  => "Te ayudamos a conocer nuestro catálogo de productos,\nsus procesos de fabricación sostenibles y su diversidad de aplicaciones/usos.",
                'col3_bullets_es' => null,

                'col3_title_en' => 'Sustainability and efficiency',
                'col3_text_en'  => "We help you discover our product catalogue,\nour sustainable manufacturing processes, and the diversity of applications/uses.",
                'col3_bullets_en' => null,

                'col3_title_fr' => 'Durabilité et efficacité',
                'col3_text_fr'  => "Nous vous aidons à découvrir notre catalogue de produits,\nnos procédés de fabrication durables et la diversité des applications/usages.",
                'col3_bullets_fr' => null,
                // ===============================================================

                // ================= BANNER =================
                'banner_image_url' => 'professionals/aplicadores-banner.jpg',

                // Si tu tabla tiene banner_image_title_*
                'banner_image_title_es' => 'Aplicadores',
                'banner_image_title_en' => 'Applicators',
                'banner_image_title_fr' => 'Applicateurs',

                // Si tu tabla tiene banner_image_alt_*
                'banner_image_alt_es' => 'Aplicadores en obra',
                'banner_image_alt_en' => 'Applicators on site',
                'banner_image_alt_fr' => 'Applicateurs sur chantier',

                // ================= FINAL =================
                'final_title_es' => 'Únete a nuestra red de aplicadores',
                'final_title_en' => 'Join our network of applicators',
                'final_title_fr' => 'Rejoignez notre réseau d’applicateurs',

                'final_description_es' => 'Pertenecer a la red de aplicadores de Grupo Estucalia ofrece múltiples ventajas para profesionales del sector. Algunas de ellas son:',
                'final_description_en' => 'Being part of Grupo Estucalia’s applicator network offers multiple benefits for industry professionals. Some of them are:',
                'final_description_fr' => "Faire partie du réseau d’applicateurs de Grupo Estucalia offre de nombreux avantages aux professionnels du secteur. En voici quelques-uns :",

                // ================= BENEFITS (JSON) =================
                // Nota: este formato asume que tu columna "benefits" es JSON
                // y que el front lo interpreta por idioma (title_es, text_es, etc.)
                'benefits' => [
                    [
                        'title_es' => 'Mayor visibilidad y oportunidades de negocio',
                        'text_es'  => 'Grupo Estucalia recomienda a sus aplicadores a constructoras y arquitectos, facilitando el acceso a proyectos de gran envergadura.',
                        'title_en' => 'Greater visibility and business opportunities',
                        'text_en'  => 'Grupo Estucalia recommends its applicators to construction companies and architects, facilitating access to large-scale projects.',
                        'title_fr' => 'Plus de visibilité et d’opportunités commerciales',
                        'text_fr'  => 'Grupo Estucalia recommande ses applicateurs aux entreprises de construction et aux architectes, facilitant l’accès à des projets d’envergure.',
                    ],
                    [
                        'title_es' => 'Acceso a productos de alta calidad',
                        'text_es'  => 'Posibilidad de trabajar con materiales innovadores y exclusivos, garantizando acabados superiores.',
                        'title_en' => 'Access to high-quality products',
                        'text_en'  => 'Opportunity to work with innovative and exclusive materials, ensuring superior finishes.',
                        'title_fr' => 'Accès à des produits de haute qualité',
                        'text_fr'  => 'Possibilité de travailler avec des matériaux innovants et exclusifs, garantissant des finitions supérieures.',
                    ],
                    [
                        'title_es' => 'Asesoramiento técnico',
                        'text_es'  => 'Conocimiento de nuevas técnicas y materiales, asegurando que los aplicadores estén siempre actualizados.',
                        'title_en' => 'Technical guidance',
                        'text_en'  => 'Knowledge of new techniques and materials, ensuring applicators are always up to date.',
                        'title_fr' => 'Conseil technique',
                        'text_fr'  => 'Connaissance des nouvelles techniques et des matériaux, afin que les applicateurs soient toujours à jour.',
                    ],
                    [
                        'title_es' => 'Respaldo y confianza de una marca consolidada',
                        'text_es'  => 'Trabajar bajo el aval de Grupo Estucalia mejora la reputación y credibilidad ante clientes y empresas del sector.',
                        'title_en' => 'Backed by a trusted brand',
                        'text_en'  => 'Working with Grupo Estucalia’s backing enhances reputation and credibility with clients and companies in the sector.',
                        'title_fr' => 'Soutien et confiance d’une marque reconnue',
                        'text_fr'  => 'Travailler sous l’aval de Grupo Estucalia renforce la réputation et la crédibilité auprès des clients et des entreprises du secteur.',
                    ],
                    [
                        'title_es' => 'Soporte comercial y técnico',
                        'text_es'  => 'Asistencia en la gestión de proyectos, soluciones a medida y apoyo en la resolución de incidencias.',
                        'title_en' => 'Commercial and technical support',
                        'text_en'  => 'Support in project management, tailored solutions, and help resolving issues.',
                        'title_fr' => 'Support commercial et technique',
                        'text_fr'  => 'Assistance dans la gestion de projets, solutions sur mesure et accompagnement dans la résolution d’incidents.',
                    ],
                    [
                        'title_es' => 'Red de contactos y colaboraciones',
                        'text_es'  => 'Posibilidad de establecer alianzas con otros profesionales del sector para potenciar el crecimiento y la expansión del negocio.',
                        'title_en' => 'Network and collaborations',
                        'text_en'  => 'Opportunity to build partnerships with other industry professionals to boost growth and business expansion.',
                        'title_fr' => 'Réseau et collaborations',
                        'text_fr'  => 'Possibilité de nouer des alliances avec d’autres professionnels du secteur afin de favoriser la croissance et le développement de l’activité.',
                    ],
                ],

                // ================= FORM TEXTS =================
                // ================= FORM TEXTS =================
                'form_privacy_es' => 'Información básica sobre Protección de Datos. Responsable: ESTUCALIA MORTEROS S.L. Finalidad del tratamiento: gestionar su consulta/solicitud, envío de información vía electrónica y su posterior seguimiento comercial. Legitimación: su consentimiento expreso al remitirnos este formulario (RGPD 6.1.a), sus datos no serán cedidos a terceros y se conservarán por plazo de un año, salvo obligación legal. Puede ejercitar los derechos de acceso, rectificación, supresión, portabilidad, limitación y oposición, y revocar su consentimiento dirigiéndose a: ',

                'form_privacy_en' => 'Basic information on Data Protection. Data Controller: ESTUCALIA MORTEROS S.L. Purpose of processing: to manage your enquiry/request, send information electronically and carry out subsequent commercial follow-up. Legal basis: your explicit consent when submitting this form (GDPR Art. 6(1)(a)). Your data will not be shared with third parties and will be kept for one year, unless a legal obligation applies. You may exercise your rights of access, rectification, erasure, portability, restriction and objection, and withdraw your consent by contacting: ',

                'form_privacy_fr' => 'Informations de base sur la protection des données. Responsable du traitement : ESTUCALIA MORTEROS S.L. Finalité du traitement : gérer votre demande/sollicitation, envoyer des informations par voie électronique et assurer le suivi commercial ultérieur. Base juridique : votre consentement explicite lors de l’envoi de ce formulaire (RGPD art. 6(1)(a)). Vos données ne seront pas communiquées à des tiers et seront conservées pendant un an, sauf obligation légale. Vous pouvez exercer vos droits d’accès, de rectification, d’effacement, de portabilité, de limitation et d’opposition, et retirer votre consentement en vous adressant à : ',


                'form_checkbox1_es' => 'Sí, he leído y acepto el tratamiento de mis datos personales según la Política de Privacidad y el Aviso Legal de Estucalia Morteros S.L.',
                'form_checkbox1_en' => 'Yes, I have read and accept the processing of my personal data according to the Privacy Policy and Legal Notice of Estucalia Morteros S.L.',
                'form_checkbox1_fr' => "Oui, j’ai lu et j’accepte le traitement de mes données personnelles conformément à la Politique de confidentialité et aux Mentions légales d’Estucalia Morteros S.L.",

                'form_checkbox2_es' => 'Sí, autorizo la recepción vía electrónica de información comercial de Grupo Estucalia.',
                'form_checkbox2_en' => 'Yes, I authorize receiving commercial information from Grupo Estucalia electronically.',
                'form_checkbox2_fr' => "Oui, j’autorise la réception d’informations commerciales de Grupo Estucalia par voie électronique.",

                // ================= SEO =================
                'seo_title_es' => 'Aplicadores | Estucalia',
                'seo_title_en' => 'Applicators | Estucalia',
                'seo_title_fr' => 'Applicateurs | Estucalia',

                'seo_description_es' => 'Únete a la red de aplicadores de Estucalia y accede a oportunidades, soporte y materiales de alta calidad.',
                'seo_description_en' => 'Join Estucalia’s applicator network and access opportunities, support, and high-quality materials.',
                'seo_description_fr' => "Rejoignez le réseau d’applicateurs d’Estucalia et accédez à des opportunités, du support et des matériaux de haute qualité.",
            ]
        );
    }
}
