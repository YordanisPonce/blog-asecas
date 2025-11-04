<?php

// app/Models/CookiesPage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CookiesPage extends Model
{
    protected $fillable = [
        'page_title_es',
        'page_title_en',
        'page_title_fr',
        'intro_es',
        'intro_en',
        'intro_fr',
        'collected_info_es',
        'collected_info_en',
        'collected_info_fr',
        'personal_data_note_es',
        'personal_data_note_en',
        'personal_data_note_fr',
        'consent_es',
        'consent_en',
        'consent_fr',
        'disable_reject_delete_es',
        'disable_reject_delete_en',
        'disable_reject_delete_fr',
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
