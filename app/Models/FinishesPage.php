<?php
// app/Models/FinishesPage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSeo; // ← IMPORTAR EL TRAIT

class FinishesPage extends Model
{
    use HasSeo; // ← AÑADIR ESTA LÍNEA

    protected $fillable = [
        'page_title_es',
        'page_title_en',
        'page_title_fr',
        'intro_es',
        'intro_en',
        'intro_fr',
        'finishes_items',
        // ⚠️ ELIMINAR LOS CAMPOS SEO ANTIGUOS
        // 'seo_title_es',
        // 'seo_title_en',
        // 'seo_title_fr',
        // 'seo_description_es',
        // 'seo_description_en',
        // 'seo_description_fr',
    ];

    protected $casts = [
        'finishes_items' => 'array',
    ];
}
