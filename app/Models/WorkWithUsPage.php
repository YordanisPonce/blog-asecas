<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkWithUsPage extends Model
{
    protected $fillable = [
        'hero_title_es',
        'hero_title_en',
        'hero_title_fr',
        'hero_bg_image',

        'section_title_es',
        'section_title_en',
        'section_title_fr',
        'section_text_es',
        'section_text_en',
        'section_text_fr',

        'field_name_label_es',
        'field_name_label_en',
        'field_name_label_fr',
        'field_phone_label_es',
        'field_phone_label_en',
        'field_phone_label_fr',
        'field_email_label_es',
        'field_email_label_en',
        'field_email_label_fr',
        'field_speciality_label_es',
        'field_speciality_label_en',
        'field_speciality_label_fr',
        'field_message_label_es',
        'field_message_label_en',
        'field_message_label_fr',

        'cv_label_es',
        'cv_label_en',
        'cv_label_fr',
        'submit_text_es',
        'submit_text_en',
        'submit_text_fr',

        'legal_info_text_es',
        'legal_info_text_en',
        'legal_info_text_fr',
        'checkbox_1_label_es',
        'checkbox_1_label_en',
        'checkbox_1_label_fr',
        'checkbox_2_label_es',
        'checkbox_2_label_en',
        'checkbox_2_label_fr',

        'seo_title_es',
        'seo_title_en',
        'seo_title_fr',
        'seo_description_es',
        'seo_description_en',
        'seo_description_fr',
    ];
}
