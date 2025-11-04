<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Empresa.php
class Empresa extends Model
{
    protected $fillable = [
        'hero_title_es','hero_title_en','hero_title_fr','hero_video_url',
        'hero_image','hero_image_title','hero_image_alt',

        'about_title_es','about_title_en','about_title_fr',
        'about_text_es','about_text_en','about_text_fr',
        'about_illustration','about_illustration_title','about_illustration_alt',

        'mission_title_es','mission_title_en','mission_title_fr',
        'mission_text_es','mission_text_en','mission_text_fr',

        'production_title_es','production_title_en','production_title_fr',
        'production_text_es','production_text_en','production_text_fr',
        'production_stat','production_media_url',
        'production_image','production_image_title','production_image_alt',

        'solutions_title_es','solutions_title_en','solutions_title_fr',
        'solutions_intro_es','solutions_intro_en','solutions_intro_fr',
        'solutions_items_es','solutions_items_en','solutions_items_fr',

        'international_title_es','international_title_en','international_title_fr',
        'international_text_es','international_text_en','international_text_fr',
        'international_image','international_image_title','international_image_alt',

        'certs_title_es','certs_title_en','certs_title_fr',
        'certs_text_es','certs_text_en','certs_text_fr','certs_logos',

        'consulting_title_es','consulting_title_en','consulting_title_fr',
        'consulting_text_es','consulting_text_en','consulting_text_fr',
        'consulting_cta_text_es','consulting_cta_text_en','consulting_cta_text_fr',
        'consulting_cta_url','consulting_bg_image','consulting_bg_image_title','consulting_bg_image_alt',
    ];

    protected $casts = [
        'solutions_items_es' => 'array',
        'solutions_items_en' => 'array',
        'solutions_items_fr' => 'array',
        'certs_logos'        => 'array',
    ];
}
