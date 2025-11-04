<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = [
        // Bloque 1
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

        // Bloque 2 (fix nombre)
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

        // Bloque 3
        'third_title_es',
        'third_title_en',
        'third_title_fr',
        'third_description_es',
        'third_description_en',
        'third_description_fr',

        // CTA central
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
        'cta_help_image_title',
        'cta_help_image_alt',

        // Applications / Finishes
        'applications_items',
        'finishes_tabs',

        // Inspiración
        'inspiration_text_es',
        'inspiration_text_en',
        'inspiration_text_fr',
        'inspiration_images_es',
        'inspiration_images_en',
        'inspiration_images_fr',

        // Blog/News CTA
        'blog_text_es',
        'blog_text_en',
        'blog_text_fr',

        // SEO
        'seo_title_es',
        'seo_title_en',
        'seo_title_fr',
        'seo_description_es',
        'seo_description_en',
        'seo_description_fr',
    ];

    protected $casts = [
        'inspiration_images_es' => 'array',
        'inspiration_images_en' => 'array',
        'inspiration_images_fr' => 'array',
        'applications_items' => 'array',
        'finishes_tabs' => 'array',
    ];
}
