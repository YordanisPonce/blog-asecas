<?php
// app/Models/FinishesPage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishesPage extends Model
{
    protected $fillable = [
        'page_title_es',
        'page_title_en',
        'page_title_fr',
        'intro_es',
        'intro_en',
        'intro_fr',
        'finishes_items',
        'seo_title_es',
        'seo_title_en',
        'seo_title_fr',
        'seo_description_es',
        'seo_description_en',
        'seo_description_fr',
    ];

    protected $casts = [
        'finishes_items' => 'array',
    ];
}
