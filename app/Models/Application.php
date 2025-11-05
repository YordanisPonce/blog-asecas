<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'photo',
        'link_url',
        'position',
        'is_active',

        // legacy (si los sigues usando)
        'name',
        'image_alt',
        'image_title',

        // i18n
        'name_es',
        'name_en',
        'name_fr',
        'image_alt_es',
        'image_alt_en',
        'image_alt_fr',
        'image_title_es',
        'image_title_en',
        'image_title_fr',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'position' => 'integer',
    ];
}
