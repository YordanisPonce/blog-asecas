<?php

// app/Models/ContactPage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    protected $fillable = [
        'map_embed_url',
        'contact_title_es',
        'contact_title_en',
        'contact_title_fr',
        'address_line',
        'city',
        'region',
        'country',
        'phones',
        'emails',
        'schedule_text_es',
        'schedule_text_en',
        'schedule_text_fr',
        'legal_info_text_es',
        'legal_info_text_en',
        'legal_info_text_fr',
        'checkbox_1_label_es',
        'checkbox_1_label_en',
        'checkbox_1_label_fr',
        'checkbox_2_label_es',
        'checkbox_2_label_en',
        'checkbox_2_label_fr',
        'cta_title_es',
        'cta_title_en',
        'cta_title_fr',
        'cta_text_es',
        'cta_text_en',
        'cta_text_fr',
        'cta_button_text_es',
        'cta_button_text_en',
        'cta_button_text_fr',
        'cta_button_url',
        'cta_bg_image',
        'cta_bg_image_title',
        'cta_bg_image_alt',
        'social_linkedin',
        'social_facebook',
        'social_instagram',
        'social_youtube',
    ];

    protected $casts = [
        'phones' => 'array',
        'emails' => 'array',
    ];
}
