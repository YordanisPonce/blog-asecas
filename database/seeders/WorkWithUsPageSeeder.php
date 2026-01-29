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
                // HERO
                'hero_title_es' => 'Trabaja con nosotros',
                'hero_title_en' => 'Work with us',
                'hero_title_fr' => 'Travaillez avec nous',
                // Deja null y la subes en Filament (FileUpload guarda el path)
                'hero_bg_image' => null,

                // SECCIÓN
                'section_title_es' => 'Trabaja con Nosotros',
                'section_title_en' => 'Work with Us',
                'section_title_fr' => 'Travaillez avec Nous',

                'section_text_es' =>
                'En Grupo Estucalia estamos siempre en busca de talento. Si eres un profesional apasionado por la construcción y la innovación, queremos conocerte. Únete a nuestro equipo y forma parte de una empresa líder en el sector de los morteros y materiales de construcción. Envíanos tu CV y cuéntanos por qué quieres trabajar con nosotros.',
                'section_text_en' =>
                'At Grupo Estucalia we are always looking for talent. If you are a professional passionate about construction and innovation, we want to meet you. Join our team and be part of a leading company in mortars and construction materials. Send us your CV and tell us why you want to work with us.',
                'section_text_fr' =>
                'Chez Grupo Estucalia, nous sommes toujours à la recherche de talents. Si vous êtes un professionnel passionné par la construction et l’innovation, nous voulons vous connaître. Rejoignez notre équipe et faites partie d’une entreprise leader dans les mortiers et les matériaux de construction. Envoyez-nous votre CV et dites-nous pourquoi vous souhaitez travailler avec nous.',

                // FORM labels (los placeholders/líneas del input)
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

                // Legal (puede ser HTML porque tu frontend ya usa dangerouslySetInnerHTML en otras páginas)
                'legal_info_text_es' =>
                '<strong>Información básica sobre Protección de Datos</strong>. Responsable: ESTUCALIA MORTEROS S.L. Finalidad del tratamiento: gestionar su consulta/solicitud, envío de información vía electrónica y su posterior seguimiento comercial. Legitimación: su consentimiento expreso al remitirnos este formulario. No se cederán a terceros y se conservarán por el plazo de un año, salvo obligación legal.',
                'legal_info_text_en' =>
                '<strong>Basic information on Data Protection</strong>. Controller: ESTUCALIA MORTEROS S.L. Purpose: manage your request/inquiry, send information electronically and subsequent commercial follow-up. Legal basis: your explicit consent when submitting this form. Data will not be shared with third parties and will be kept for one year, unless legally required.',
                'legal_info_text_fr' =>
                '<strong>Informations de base sur la protection des données</strong>. Responsable : ESTUCALIA MORTEROS S.L. Finalité : gérer votre demande, envoyer des informations par voie électronique et assurer le suivi commercial. Base légale : votre consentement explicite lors de l’envoi du formulaire. Les données ne seront pas cédées à des tiers et seront conservées pendant un an, sauf obligation légale.',

                'checkbox_1_label_es' =>
                'He leído y acepto el tratamiento de mis datos personales según la Política de Privacidad y el Aviso Legal de Grupo Estucalia.',
                'checkbox_1_label_en' =>
                'I have read and accept the processing of my personal data according to the Privacy Policy and Legal Notice of Grupo Estucalia.',
                'checkbox_1_label_fr' =>
                'J’ai lu et j’accepte le traitement de mes données personnelles conformément à la Politique de confidentialité et aux Mentions légales de Grupo Estucalia.',

                'checkbox_2_label_es' =>
                'Sí, autorizo la recepción vía electrónica de información comercial de Grupo Estucalia.',
                'checkbox_2_label_en' =>
                'Yes, I authorize receiving commercial information from Grupo Estucalia electronically.',
                'checkbox_2_label_fr' =>
                'Oui, j’autorise la réception d’informations commerciales de Grupo Estucalia par voie électronique.',

                // SEO (opcional)
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
