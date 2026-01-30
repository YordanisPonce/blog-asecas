<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkWithUsPage;

class WorkWithUsPageSeeder extends Seeder
{
    public function run(): void
    {
        WorkWithUsPage::updateOrCreate(
            ['id' => 1],
            [
                // ================= HERO =================
                'hero_title_es' => '<h1 class="text-white text-4xl md:text-5xl font-[600] text-center max-w-2xl leading-tight">Trabaja con nosotros</h1>',
                'hero_title_en' => '<h1 class="text-white text-4xl md:text-5xl font-[600] text-center max-w-2xl leading-tight">Work with us</h1>',
                'hero_title_fr' => '<h1 class="text-white text-4xl md:text-5xl font-[600] text-center max-w-2xl leading-tight">Travaillez avec nous</h1>',

                // ✅ Imagen en /public/work-with-us/trabajaconnosotros.png
                // (si algún día la subes por Filament, normalmente quedará en storage/public/work-with-us/...)
                'hero_bg_image' => 'work-with-us/trabajaconnosotros.png',

                // ================= SECCIÓN =================
                'section_title_es' => '<h2 class="text-3xl font-[600] mb-3">Trabaja con Nosotros</h2>',
                'section_title_en' => '<h2 class="text-3xl font-[600] mb-3">Work with Us</h2>',
                'section_title_fr' => '<h2 class="text-3xl font-[600] mb-3">Travaillez avec Nous</h2>',

                'section_text_es' => '<p class="text-gray-900 text-base leading-relaxed">En Grupo Estucalia estamos siempre en busca de talento. Si eres un profesional apasionado por la construcción y la innovación, queremos conocerte. Únete a nuestro equipo y forma parte de una empresa líder en el sector de los morteros y materiales de construcción. <strong>Envíanos tu CV</strong> y cuéntanos por qué quieres trabajar con nosotros.</p>',
                'section_text_en' => '<p class="text-gray-900 text-base leading-relaxed">At Grupo Estucalia we are always looking for talent. If you are a professional passionate about construction and innovation, we want to meet you. Join our team and be part of a leading company in mortars and construction materials. <strong>Send us your CV</strong> and tell us why you want to work with us.</p>',
                'section_text_fr' => '<p class="text-gray-900 text-base leading-relaxed">Chez Grupo Estucalia, nous sommes toujours à la recherche de talents. Si vous êtes un professionnel passionné par la construction et l’innovation, nous voulons vous connaître. Rejoignez notre équipe et faites partie d’une entreprise leader dans les mortiers et les matériaux de construction. <strong>Envoyez-nous votre CV</strong> et dites-nous pourquoi vous souhaitez travailler avec nous.</p>',

                // ================= FORM LABELS =================
                'field_name_label_es' => 'Nombre',
                'field_name_label_en' => 'Name',
                'field_name_label_fr' => 'Nom',

                'field_phone_label_es' => 'Teléfono',
                'field_phone_label_en' => 'Phone',
                'field_phone_label_fr' => 'Téléphone',

                'field_email_label_es' => 'E-mail',
                'field_email_label_en' => 'E-mail',
                'field_email_label_fr' => 'E-mail',

                'field_speciality_label_es' => 'Especialidad',
                'field_speciality_label_en' => 'Speciality',
                'field_speciality_label_fr' => 'Spécialité',

                'field_message_label_es' => 'Mensaje',
                'field_message_label_en' => 'Message',
                'field_message_label_fr' => 'Message',

                'cv_label_es' => 'Adjuntar CV',
                'cv_label_en' => 'Attach CV',
                'cv_label_fr' => 'Joindre CV',

                'submit_text_es' => 'Enviar',
                'submit_text_en' => 'Send',
                'submit_text_fr' => 'Envoyer',

                // ================= LEGAL + CHECKBOXES (HTML) =================
                'legal_info_text_es' =>
                '<p class="text-sm font-semibold text-[#2f4d7a]">Información básica sobre Protección de Datos</p>
                    ',

                'legal_info_text_en' =>
                '<p class="text-sm font-semibold text-[#2f4d7a]">Basic information on Data Protection</p>
                     <p class="text-sm text-gray-900 mt-2">
                       <strong>Controller:</strong> ESTUCALIA MORTEROS S.L. <strong>Purpose:</strong> manage your request/inquiry, send information electronically and subsequent commercial follow-up.
                       <strong>Legal basis:</strong> your explicit consent when submitting this form. Data will not be shared with third parties and will be kept for one year, unless legally required.
                     </p>',

                'legal_info_text_fr' =>
                '<p class="text-sm font-semibold text-[#2f4d7a]">Informations de base sur la protection des données</p>
                     <p class="text-sm text-gray-900 mt-2">
                       <strong>Responsable :</strong> ESTUCALIA MORTEROS S.L. <strong>Finalité :</strong> gérer votre demande, envoyer des informations par voie électronique et assurer le suivi commercial.
                       <strong>Base légale :</strong> votre consentement explicite lors de l’envoi du formulaire. Les données ne seront pas cédées à des tiers et seront conservées pendant un an, sauf obligation légale.
                     </p>',

                // ✅ Checkbox 1 con links internos
                'checkbox_1_label_es' =>
                '<span class="text-sm text-gray-900">He leído y acepto la </span>
                     <a class="text-sm underline text-blue-700" href="/politica-privacidad">Política de Privacidad</a>
                     <span class="text-sm text-gray-900"> común y </span>
                     <a class="text-sm underline text-blue-700" href="/aviso-legal">Aviso Legal</a>
                     <span class="text-sm text-gray-900"> de Grupo Estucalia.</span>',

                'checkbox_1_label_en' =>
                '<span class="text-sm text-gray-900">I have read and accept the </span>
                     <a class="text-sm underline text-blue-700" href="/politica-privacidad">Privacy Policy</a>
                     <span class="text-sm text-gray-900"> and </span>
                     <a class="text-sm underline text-blue-700" href="/aviso-legal">Legal Notice</a>
                     <span class="text-sm text-gray-900"> of Grupo Estucalia.</span>',

                'checkbox_1_label_fr' =>
                '<span class="text-sm text-gray-900">J’ai lu et j’accepte la </span>
                     <a class="text-sm underline text-blue-700" href="/politica-privacidad">Politique de confidentialité</a>
                     <span class="text-sm text-gray-900"> et les </span>
                     <a class="text-sm underline text-blue-700" href="/aviso-legal">Mentions légales</a>
                     <span class="text-sm text-gray-900"> de Grupo Estucalia.</span>',

                'checkbox_2_label_es' =>
                '<span class="text-sm text-gray-900">Sí, autorizo la recepción vía electrónica de información comercial de Grupo Estucalia.</span>',
                'checkbox_2_label_en' =>
                '<span class="text-sm text-gray-900">Yes, I authorize receiving commercial information from Grupo Estucalia electronically.</span>',
                'checkbox_2_label_fr' =>
                '<span class="text-sm text-gray-900">Oui, j’autorise la réception d’informations commerciales de Grupo Estucalia par voie électronique.</span>',

                // ================= SEO =================
                'seo_title_es' => 'Trabaja con nosotros | Grupo Estucalia',
                'seo_title_en' => 'Work with us | Grupo Estucalia',
                'seo_title_fr' => 'Travaillez avec nous | Grupo Estucalia',

                'seo_description_es' => 'Únete al equipo de Grupo Estucalia. Envíanos tu CV y cuéntanos por qué quieres trabajar con nosotros.',
                'seo_description_en' => 'Join Grupo Estucalia. Send us your CV and tell us why you want to work with us.',
                'seo_description_fr' => 'Rejoignez Grupo Estucalia. Envoyez votre CV et dites-nous pourquoi vous souhaitez travailler avec nous.',
            ]
        );
    }
}
