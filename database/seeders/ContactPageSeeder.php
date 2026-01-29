<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactPage;

class ContactPageSeeder extends Seeder
{
    public function run(): void
    {
        ContactPage::updateOrCreate(
            ['id' => 1],
            [
                // MAPA (pon aquí tu embed real)
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3143.8554454554455!2d-1.0547893!3d38.0547892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd63875b8b8b8b8b%3A0x1d1d1d1d1d1d1d1d!2sGrupo%20Estucalia!5e0!3m2!1ses!2ses!4v1620000000000!5m2!1ses!2ses',

                // TÍTULO
                'contact_title_es' => 'Contacto',
                'contact_title_en' => 'Contact',
                'contact_title_fr' => 'Contact',

                // DIRECCIÓN (como en la captura)
                'address_line' => 'Camino Viejo de Fortuna, 40',
                'city' => '30148 Matanzas, Santomera',
                'region' => 'Murcia',
                'country' => 'SPAIN',

                // TELÉFONOS / EMAILS (arrays)
                'phones' => [
                    ['label' => '', 'number' => '+34 968 862 467'],
                    ['label' => '', 'number' => '+34 663 519 854'],
                ],
                'emails' => [
                    ['label' => '', 'email' => 'grupoestucalia@grupoestucalia.com'],
                ],

                // HORARIO (puede ser texto plano con saltos)
                'schedule_text_es' => "Horario\n\nLunes - Jueves\n08:00 AM - 18:00 PM\n\nViernes\n08:00 AM - 14:00 PM\n\nVerano (del 15 Julio al 15 Septiembre)\n07:00 AM - 15:00 PM",
                'schedule_text_en' => "Hours\n\nMonday - Thursday\n08:00 AM - 06:00 PM\n\nFriday\n08:00 AM - 02:00 PM\n\nSummer (July 15 to September 15)\n07:00 AM - 03:00 PM",
                'schedule_text_fr' => "Horaires\n\nLundi - Jeudi\n08:00 - 18:00\n\nVendredi\n08:00 - 14:00\n\nÉté (du 15 juillet au 15 septembre)\n07:00 - 15:00",

                // TEXTO LEGAL (en tu UI se ve como un párrafo largo debajo del textarea)
                // Si lo renderizas con dangerouslySetInnerHTML, puedes meter <br> y <strong>.
                'legal_info_text_es' =>
                "Información básica sobre Protección de Datos. Responsable: ESTUCALIA MORTEROS S.L. " .
                    "Finalidad del tratamiento: gestionar su consulta/solicitud, envío de información vía electrónica y su posterior seguimiento comercial. " .
                    "Legitimación: su consentimiento expreso al remitirnos este formulario (RGPD 6.1.a). " .
                    "Sus datos no serán cedidos a terceros y se conservarán por plazo de un año, salvo obligación legal. " .
                    "Puede ejercitar los derechos de acceso, rectificación, supresión, portabilidad, limitación y oposición, y revocar su consentimiento dirigiéndose a:",

                'legal_info_text_en' =>
                "Basic information on Data Protection. Controller: ESTUCALIA MORTEROS S.L. " .
                    "Purpose: to manage your enquiry/request, send information electronically and follow up for commercial purposes. " .
                    "Lawful basis: your explicit consent when submitting this form (GDPR 6(1)(a)). " .
                    "Your data will not be shared with third parties and will be kept for one year unless legally required otherwise. " .
                    "You may exercise your rights of access, rectification, erasure, portability, restriction and objection, and withdraw your consent by contacting:",

                'legal_info_text_fr' =>
                "Informations de base sur la protection des données. Responsable : ESTUCALIA MORTEROS S.L. " .
                    "Finalité : gérer votre demande, envoyer des informations par voie électronique et assurer le suivi commercial. " .
                    "Base légale : votre consentement explicite lors de l’envoi de ce formulaire (RGPD 6(1)(a)). " .
                    "Vos données ne seront pas cédées à des tiers et seront conservées pendant un an, sauf obligation légale. " .
                    "Vous pouvez exercer vos droits d’accès, de rectification, d’effacement, de portabilité, de limitation et d’opposition, et retirer votre consentement en vous adressant à :",

                // CHECKBOXES (como en la captura)
                'checkbox_1_label_es' =>
                'Sí, he leído y acepto el tratamiento de mis datos personales según la Política de Privacidad y el Aviso Legal de Estucalia Morteros S.L.',
                'checkbox_1_label_en' =>
                'Yes, I have read and accept the processing of my personal data according to the Privacy Policy and Legal Notice of Estucalia Morteros S.L.',
                'checkbox_1_label_fr' =>
                'Oui, j’ai lu et j’accepte le traitement de mes données personnelles conformément à la Politique de confidentialité et aux Mentions légales d’Estucalia Morteros S.L.',

                'checkbox_2_label_es' =>
                'Sí, autorizo la recepción vía electrónica de información comercial de Grupo Estucalia.',
                'checkbox_2_label_en' =>
                'Yes, I authorize receiving commercial information from Grupo Estucalia by electronic means.',
                'checkbox_2_label_fr' =>
                'Oui, j’autorise la réception par voie électronique d’informations commerciales de Grupo Estucalia.',

                // CTA (en tu captura este bloque parece ser el "ProjectHelpSection",
                // aquí te dejo valores por defecto coherentes)
                'cta_title_es' => '¿Necesitas ayuda con tu proyecto?',
                'cta_title_en' => 'Do you need help with your project?',
                'cta_title_fr' => 'Besoin d’aide pour votre projet ?',

                'cta_text_es' => 'Cuéntanos qué necesitas y te asesoramos sin compromiso.',
                'cta_text_en' => 'Tell us what you need and we’ll advise you with no obligation.',
                'cta_text_fr' => 'Dites-nous ce dont vous avez besoin et nous vous conseillerons sans engagement.',

                'cta_button_text_es' => 'Contactar',
                'cta_button_text_en' => 'Contact',
                'cta_button_text_fr' => 'Contacter',

                'cta_button_url' => '/contacto',

                // Imagen CTA (si ya lo vas a manejar con FileUpload, aquí debe ir el PATH en storage/public)
                // Ejemplo: 'contact/cta-bg.jpg'
                'cta_bg_image' => null,
                'cta_bg_image_title' => null,
                'cta_bg_image_alt' => null,

                // Redes (pon tus enlaces reales)
                'social_linkedin' => null,
                'social_facebook' => null,
                'social_instagram' => null,
                'social_youtube' => null,
            ]
        );
    }
}
