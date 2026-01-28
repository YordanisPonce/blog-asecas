<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspirationPage extends Model
{
    protected $fillable = [
        'title_es',
        'title_en',
        'title_fr',
        'description_es',
        'description_en',
        'description_fr',
        'seo_title_es',
        'seo_title_en',
        'seo_title_fr',
        'seo_description_es',
        'seo_description_en',
        'seo_description_fr',
        'default_limit',
    ];

    protected $casts = [
        'default_limit' => 'integer',
    ];
}
