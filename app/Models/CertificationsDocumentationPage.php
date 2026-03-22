<?php
// app/Models/CertificationsDocumentationPage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSeo; // ← IMPORTAR EL TRAIT

class CertificationsDocumentationPage extends Model
{
    use HasSeo; // ← AÑADIR ESTA LÍNEA

    protected $fillable = [
        'title_es',
        'title_en',
        'title_fr',

        'documents',

        'solutions_title_es',
        'solutions_title_en',
        'solutions_title_fr',

        'solutions_description_es',
        'solutions_description_en',
        'solutions_description_fr',

        'featured_categories',

        // ⚠️ ELIMINAR LOS CAMPOS SEO ANTIGUOS
        // 'seo_title_es',
        // 'seo_title_en',
        // 'seo_title_fr',
        // 'seo_description_es',
        // 'seo_description_en',
        // 'seo_description_fr',
    ];

    protected $casts = [
        'documents' => 'array',
        'featured_categories' => 'array',
    ];
}
