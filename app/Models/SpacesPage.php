<?php
// app/Models/SpacesPage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpacesPage extends Model
{
    protected $fillable = [
        'title_es',
        'title_en',
        'title_fr',
        'description_es',
        'description_en',
        'description_fr',
        'image_url',
        'image_title_es',
        'image_title_en',
        'image_title_fr',
        'image_alt_es',
        'image_alt_en',
        'image_alt_fr',
        'seo_title_es',
        'seo_title_en',
        'seo_title_fr',
        'seo_description_es',
        'seo_description_en',
        'seo_description_fr',
    ];
}
