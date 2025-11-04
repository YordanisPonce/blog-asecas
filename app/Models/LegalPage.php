<?php

// app/Models/LegalPage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalPage extends Model
{
    protected $fillable = [
        'page_title_es',
        'page_title_en',
        'page_title_fr',
        'ident_info_es',
        'ident_info_en',
        'ident_info_fr',
        'ip_rights_es',
        'ip_rights_en',
        'ip_rights_fr',
        'terms_use_es',
        'terms_use_en',
        'terms_use_fr',
        'warranty_exclusion_es',
        'warranty_exclusion_en',
        'warranty_exclusion_fr',
        'security_measures_es',
        'security_measures_en',
        'security_measures_fr',
        'modifications_es',
        'modifications_en',
        'modifications_fr',
        'applicable_law_es',
        'applicable_law_en',
        'applicable_law_fr',
        'last_updated_at',
        'seo_title_es',
        'seo_title_en',
        'seo_title_fr',
        'seo_description_es',
        'seo_description_en',
        'seo_description_fr',
    ];

    protected $casts = [
        'last_updated_at' => 'date',
    ];
}
