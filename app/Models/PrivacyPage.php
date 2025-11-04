<?php

// app/Models/PrivacyPage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivacyPage extends Model
{
    protected $fillable = [
        'page_title_es',
        'page_title_en',
        'page_title_fr',
        'intro_es',
        'intro_en',
        'intro_fr',
        'controller_info_es',
        'controller_info_en',
        'controller_info_fr',
        'purpose_es',
        'purpose_en',
        'purpose_fr',
        'legal_basis_es',
        'legal_basis_en',
        'legal_basis_fr',
        'security_measures_es',
        'security_measures_en',
        'security_measures_fr',
        'data_sharing_es',
        'data_sharing_en',
        'data_sharing_fr',
        'intl_transfers_es',
        'intl_transfers_en',
        'intl_transfers_fr',
        'retention_es',
        'retention_en',
        'retention_fr',
        'rights_howto_es',
        'rights_howto_en',
        'rights_howto_fr',
        'modifications_es',
        'modifications_en',
        'modifications_fr',
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
