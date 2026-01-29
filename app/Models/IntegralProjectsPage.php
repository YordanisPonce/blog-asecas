<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntegralProjectsPage extends Model
{
    protected $table = 'integral_projects_pages';

    protected $fillable = [
        'hero_title_es',
        'hero_title_en',
        'hero_title_fr',
        'hero_description_es',
        'hero_description_en',
        'hero_description_fr',
        'hero_image_url',
        'hero_image_title_es',
        'hero_image_title_en',
        'hero_image_title_fr',
        'hero_image_alt_es',
        'hero_image_alt_en',
        'hero_image_alt_fr',

        'col1_title_es',
        'col1_title_en',
        'col1_title_fr',
        'col1_text_es',
        'col1_text_en',
        'col1_text_fr',
        'col1_bullets_es',
        'col1_bullets_en',
        'col1_bullets_fr',

        'col2_title_es',
        'col2_title_en',
        'col2_title_fr',
        'col2_text_es',
        'col2_text_en',
        'col2_text_fr',
        'col2_bullets_es',
        'col2_bullets_en',
        'col2_bullets_fr',

        'col3_title_es',
        'col3_title_en',
        'col3_title_fr',
        'col3_text_es',
        'col3_text_en',
        'col3_text_fr',
        'col3_bullets_es',
        'col3_bullets_en',
        'col3_bullets_fr',

        'cards',

        'banner_image_url',
        'banner_image_title_es',
        'banner_image_title_en',
        'banner_image_title_fr',
        'banner_image_alt_es',
        'banner_image_alt_en',
        'banner_image_alt_fr',

        'seo_title_es',
        'seo_title_en',
        'seo_title_fr',
        'seo_description_es',
        'seo_description_en',
        'seo_description_fr',
    ];

    protected $casts = [
        'cards' => 'array',
    ];
}
