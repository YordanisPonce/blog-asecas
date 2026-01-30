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

                'hero_description_es' => null,
                'hero_description_en' => null,
                'hero_description_fr' => null,

                // ✅ Nueva imagen HERO
                'hero_image_url' => 'professionals/closeup-construction-worker039s-hands-wearing-protective-gloves.jpg',

                'hero_image_title_es' => 'Aplicadores',
                'hero_image_title_en' => 'Applicators',
                'hero_image_title_fr' => 'Applicateurs',

                'hero_image_alt_es' => 'Manos de aplicador con guantes de protección',
                'hero_image_alt_en' => 'Close-up of a worker’s hands wearing protective gloves',
                'hero_image_alt_fr' => 'Gros plan sur les mains d’un ouvrier portant des gants de protection',

                // ================== 3 BLOQUES (COLUMNA 1/2/3) ==================
                // ✅ Titles y textos en HTML con tus clases

                // ---- COL 1
                'col1_title_es' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Asistencia y soporte</h3>',
                'col1_text_es'  => '<p class="text-xl mb-4">Nuestros especialistas están a tu disposición para ayudarte a nivel comercial y en materia de seguridad. Asesoramos sobre transporte, manipulación, aplicación y mantenimiento.</p>',
                'col1_bullets_es' => null,

                'col1_title_en' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Assistance and support</h3>',
                'col1_text_en'  => '<p class="text-xl mb-4">Our specialists are at your disposal to support you commercially and in safety matters. We advise on transport, handling, application and maintenance.</p>',
                'col1_bullets_en' => null,

                'col1_title_fr' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Assistance et support</h3>',
                'col1_text_fr'  => '<p class="text-xl mb-4">Nos spécialistes sont à votre disposition pour vous aider sur le plan commercial et en matière de sécurité. Nous conseillons sur le transport, la manutention, l’application et la maintenance.</p>',
                'col1_bullets_fr' => null,

                // ---- COL 2
                'col2_title_es' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Servicio de entrega mundial</h3>',
                'col2_text_es'  => '<p class="text-xl mb-4">Disfruta de un servicio de entrega de alcance mundial para hacer crecer tu proyecto.</p>',
                'col2_bullets_es' => null,

                'col2_title_en' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Worldwide delivery service</h3>',
                'col2_text_en'  => '<p class="text-xl mb-4">Enjoy a worldwide delivery service to help your project grow.</p>',
                'col2_bullets_en' => null,

                'col2_title_fr' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Service de livraison mondial</h3>',
                'col2_text_fr'  => '<p class="text-xl mb-4">Profitez d’un service de livraison à l’échelle mondiale pour développer votre projet.</p>',
                'col2_bullets_fr' => null,

                // ---- COL 3
                'col3_title_es' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Sostenibilidad y eficiencia</h3>',
                'col3_text_es'  => '<p class="text-xl mb-4">Te ayudamos a conocer nuestro catálogo de productos, sus procesos de fabricación sostenibles y su diversidad de aplicaciones/usos.</p>',
                'col3_bullets_es' => null,

                'col3_title_en' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Sustainability and efficiency</h3>',
                'col3_text_en'  => '<p class="text-xl mb-4">We help you discover our product catalogue, our sustainable manufacturing processes, and the diversity of applications/uses.</p>',
                'col3_bullets_en' => null,

                'col3_title_fr' => '<h3 class="text-xl font-semibold mb-2 border-b border-black border-solid">Durabilité et efficacité</h3>',
                'col3_text_fr'  => '<p class="text-xl mb-4">Nous vous aidons à découvrir notre catalogue de produits, nos procédés de fabrication durables et la diversité des applications/usages.</p>',
                'col3_bullets_fr' => null,

                // ================= BANNER =================
                // ✅ Nueva imagen BANNER
                'banner_image_url' => 'professionals/tiler-working-renovation-apartment.jpg',

                'banner_image_title_es' => 'Aplicadores',
                'banner_image_title_en' => 'Applicators',
                'banner_image_title_fr' => 'Applicateurs',

                'banner_image_alt_es' => 'Aplicador trabajando en reforma',
                'banner_image_alt_en' => 'Tiler working during an apartment renovation',
                'banner_image_alt_fr' => 'Carreleur au travail lors de la rénovation d’un appartement',

                // ================= FINAL (CONTACT / CTA + BENEFITS) =================
                // ✅ Final title como H2 HTML
                'final_title_es' => '<h2 class="text-4xl font-[600] w-[21rem] mb-3">Únete a nuestra red de aplicadores</h2>',
                'final_title_en' => '<h2 class="text-4xl font-[600] w-[21rem] mb-3">Join our network of applicators</h2>',
                'final_title_fr' => '<h2 class="text-4xl font-[600] w-[21rem] mb-3">Rejoignez notre réseau d’applicateurs</h2>',

                // ✅ Final description como P HTML
                'final_description_es' => '<p class="text-gray-900 text-xl inline leading-relaxed">Pertenecer a la red de aplicadores de Grupo Estucalia ofrece múltiples ventajas para profesionales del sector. Algunas de ellas son:</p>',
                'final_description_en' => '<p class="text-gray-900 text-xl inline leading-relaxed">Being part of Grupo Estucalia’s applicator network offers multiple benefits for industry professionals. Some of them are:</p>',
                'final_description_fr' => '<p class="text-gray-900 text-xl inline leading-relaxed">Faire partie du réseau d’applicateurs de Grupo Estucalia offre de nombreux avantages aux professionnels du secteur. En voici quelques-uns :</p>',

                // ================= BENEFITS (JSON) =================
                'benefits' => [
                    [
                        'title_es' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Mayor visibilidad y oportunidades de negocio</p>',
                        'text_es'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Grupo Estucalia recomienda a sus aplicadores a constructoras y arquitectos, facilitando el acceso a proyectos de gran envergadura.</p>',

                        'title_en' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Greater visibility and business opportunities</p>',
                        'text_en'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Grupo Estucalia recommends its applicators to construction companies and architects, facilitating access to large-scale projects.</p>',

                        'title_fr' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Plus de visibilité et d’opportunités commerciales</p>',
                        'text_fr'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Grupo Estucalia recommande ses applicateurs aux entreprises de construction et aux architectes, facilitant l’accès à des projets d’envergure.</p>',
                    ],
                    [
                        'title_es' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Acceso a productos de alta calidad</p>',
                        'text_es'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Posibilidad de trabajar con materiales innovadores y exclusivos, garantizando acabados superiores.</p>',

                        'title_en' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Access to high-quality products</p>',
                        'text_en'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Opportunity to work with innovative and exclusive materials, ensuring superior finishes.</p>',

                        'title_fr' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Accès à des produits de haute qualité</p>',
                        'text_fr'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Possibilité de travailler avec des matériaux innovants et exclusifs, garantissant des finitions supérieures.</p>',
                    ],
                    [
                        'title_es' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Asesoramiento técnico</p>',
                        'text_es'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Conocimiento de nuevas técnicas y materiales, asegurando que los aplicadores estén siempre actualizados.</p>',

                        'title_en' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Technical guidance</p>',
                        'text_en'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Knowledge of new techniques and materials, ensuring applicators are always up to date.</p>',

                        'title_fr' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Conseil technique</p>',
                        'text_fr'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Connaissance des nouvelles techniques et des matériaux, afin que les applicateurs soient toujours à jour.</p>',
                    ],
                    [
                        'title_es' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Respaldo y confianza de una marca consolidada</p>',
                        'text_es'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Trabajar bajo el aval de Grupo Estucalia mejora la reputación y credibilidad ante clientes y empresas del sector.</p>',

                        'title_en' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Backed by a trusted brand</p>',
                        'text_en'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Working with Grupo Estucalia’s backing enhances reputation and credibility with clients and companies in the sector.</p>',

                        'title_fr' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Soutien et confiance d’une marque reconnue</p>',
                        'text_fr'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Travailler sous l’aval de Grupo Estucalia renforce la réputation et la crédibilité auprès des clients et des entreprises du secteur.</p>',
                    ],
                    [
                        'title_es' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Soporte comercial y técnico</p>',
                        'text_es'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Asistencia en la gestión de proyectos, soluciones a medida y apoyo en la resolución de incidencias.</p>',

                        'title_en' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Commercial and technical support</p>',
                        'text_en'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Support in project management, tailored solutions, and help resolving issues.</p>',

                        'title_fr' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Support commercial et technique</p>',
                        'text_fr'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Assistance dans la gestion de projets, solutions sur mesure et accompagnement dans la résolution d’incidents.</p>',
                    ],
                    [
                        'title_es' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Red de contactos y colaboraciones</p>',
                        'text_es'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Posibilidad de establecer alianzas con otros profesionales del sector para potenciar el crecimiento y la expansión del negocio.</p>',

                        'title_en' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Network and collaborations</p>',
                        'text_en'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Opportunity to build partnerships with other industry professionals to boost growth and business expansion.</p>',

                        'title_fr' => '<p class="text-gray-900 font-[600] text-lg inline leading-relaxed">Réseau et collaborations</p>',
                        'text_fr'  => '<p class="text-gray-900 text-lg inline leading-relaxed">Possibilité de nouer des alliances avec d’autres professionnels du secteur afin de favoriser la croissance et le développement de l’activité.</p>',
                    ],
                ],

                // ================= FORM TEXTS =================
                'form_privacy_es' => '<p class="text-sm col-span-2">Información básica sobre Protección de Datos. Responsable: ESTUCALIA MORTEROS S.L. Finalidad del tratamiento: gestionar su consulta/solicitud, envío de información vía electrónica y su posterior seguimiento comercial. Legitimación: su consentimiento expreso al remitirnos este formulario (RGPD 6.1.a), sus datos no serán cedidos a terceros y se conservarán por plazo de un año, salvo obligación legal. Puede ejercitar los derechos de acceso, rectificación, supresión, portabilidad, limitación y oposición, y revocar su consentimiento dirigiéndose a:</p>',

                'form_privacy_en' => '<p class="text-sm col-span-2">Basic information on Data Protection. Data Controller: ESTUCALIA MORTEROS S.L. Purpose of processing: to manage your enquiry/request, send information electronically and carry out subsequent commercial follow-up. Legal basis: your explicit consent when submitting this form (GDPR Art. 6(1)(a)). Your data will not be shared with third parties and will be kept for one year, unless a legal obligation applies. You may exercise your rights of access, rectification, erasure, portability, restriction and objection, and withdraw your consent by contacting:</p>',

                'form_privacy_fr' => '<p class="text-sm col-span-2">Informations de base sur la protection des données. Responsable du traitement : ESTUCALIA MORTEROS S.L. Finalité du traitement : gérer votre demande/sollicitation, envoyer des informations par voie électronique et assurer le suivi commercial ultérieur. Base juridique : votre consentement explicite lors de l’envoi de ce formulaire (RGPD art. 6(1)(a)). Vos données ne seront pas communiquées à des tiers et seront conservées pendant un an, sauf obligation légale. Vous pouvez exercer vos droits d’accès, de rectification, d’effacement, de portabilité, de limitation et d’opposition, et retirer votre consentement en vous adressant à :</p>',

                'form_checkbox1_es' => '<label class="font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm text-gray-900" for="privacy_policy">Sí, he leído y acepto el tratamiento de mis datos personales según la Política de Privacidad y el Aviso Legal de Estucalia Morteros S.L.</label>',
                'form_checkbox1_en' => '<label class="font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm text-gray-900" for="privacy_policy">Yes, I have read and accept the processing of my personal data according to the Privacy Policy and Legal Notice of Estucalia Morteros S.L.</label>',
                'form_checkbox1_fr' => '<label class="font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm text-gray-900" for="privacy_policy">Oui, j’ai lu et j’accepte le traitement de mes données personnelles conformément à la Politique de confidentialité et aux Mentions légales d’Estucalia Morteros S.L.</label>',

                'form_checkbox2_es' => '<label class="font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm text-gray-900" for="commercial_info">Sí, autorizo la recepción vía electrónica de información comercial de Grupo Estucalia.</label>',
                'form_checkbox2_en' => '<label class="font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm text-gray-900" for="commercial_info">Yes, I authorize receiving commercial information from Grupo Estucalia electronically.</label>',
                'form_checkbox2_fr' => '<label class="font-medium peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm text-gray-900" for="commercial_info">Oui, j’autorise la réception d’informations commerciales de Grupo Estucalia par voie électronique.</label>',

                // ================= SEO =================
                'seo_title_es' => 'Aplicadores | Estucalia',
                'seo_title_en' => 'Applicators | Estucalia',
                'seo_title_fr' => 'Applicateurs | Estucalia',

                'seo_description_es' => 'Únete a la red de aplicadores de Estucalia y accede a oportunidades, soporte y materiales de alta calidad.',
                'seo_description_en' => 'Join Estucalia’s applicator network and access opportunities, support, and high-quality materials.',
                'seo_description_fr' => 'Rejoignez le réseau d’applicateurs d’Estucalia et accédez à des opportunités, du support et des matériaux de haute qualité.',
            ]
        );
    }
}
