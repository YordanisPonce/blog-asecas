<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = [
        // HERO
        'first_title_es',
        'first_title_en',
        'first_title_fr',
        'first_description_es',
        'first_description_en',
        'first_description_fr',
        'first_image_url',
        'first_image_title_es',
        'first_image_title_en',
        'first_image_title_fr',
        'first_image_alt_es',
        'first_image_alt_en',
        'first_image_alt_fr',

        // BLOQUE 2
        'second_title_es',
        'second_title_en',
        'second_title_fr',
        'second_description_es',
        'second_description_en',
        'second_description_fr',
        'second_image_url',
        'second_image_title_es',
        'second_image_title_en',
        'second_image_title_fr',
        'second_image_alt_es',
        'second_image_alt_en',
        'second_image_alt_fr',

        // CTA HELP
        'cta_help_title_es',
        'cta_help_title_en',
        'cta_help_title_fr',
        'cta_help_text_es',
        'cta_help_text_en',
        'cta_help_text_fr',
        'cta_help_button_es',
        'cta_help_button_en',
        'cta_help_button_fr',
        'cta_help_url',
        'cta_help_image_url',
        'cta_help_image_title_es',
        'cta_help_image_title_en',
        'cta_help_image_title_fr',
        'cta_help_image_alt_es',
        'cta_help_image_alt_en',
        'cta_help_image_alt_fr',

        // SEO
        'seo_title_es',
        'seo_title_en',
        'seo_title_fr',
        'seo_description_es',
        'seo_description_en',
        'seo_description_fr',
    ];
}
