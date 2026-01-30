<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterPage extends Model
{
    protected $fillable = [
        'logo',

        'legal_title_es',
        'legal_title_en',
        'legal_title_fr',
        'company_title_es',
        'company_title_en',
        'company_title_fr',
        'products_title_es',
        'products_title_en',
        'products_title_fr',
        'contact_title_es',
        'contact_title_en',
        'contact_title_fr',
        'follow_title_es',
        'follow_title_en',
        'follow_title_fr',

        'legal_links_es',
        'legal_links_en',
        'legal_links_fr',
        'company_links_es',
        'company_links_en',
        'company_links_fr',
        'products_links_es',
        'products_links_en',
        'products_links_fr',

        'contact_address_html_es',
        'contact_address_html_en',
        'contact_address_html_fr',
        'contact_phone_1',
        'contact_phone_2',
        'contact_email',

        'social_links_es',
        'social_links_en',
        'social_links_fr',

        'copyright_text_es',
        'copyright_text_en',
        'copyright_text_fr',
    ];

    protected $casts = [
        'legal_links_es' => 'array',
        'legal_links_en' => 'array',
        'legal_links_fr' => 'array',

        'company_links_es' => 'array',
        'company_links_en' => 'array',
        'company_links_fr' => 'array',

        'products_links_es' => 'array',
        'products_links_en' => 'array',
        'products_links_fr' => 'array',

        'social_links_es' => 'array',
        'social_links_en' => 'array',
        'social_links_fr' => 'array',
    ];
}
