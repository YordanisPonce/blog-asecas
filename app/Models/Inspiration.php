<?php
// app/Models/Inspiration.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspiration extends Model
{
    protected $fillable = [
        'image_path',
        'title_es',
        'title_en',
        'title_fr',
        'alt_es',
        'alt_en',
        'alt_fr',
        'position',
        'is_active',
    ];

    protected $casts = [
        'position' => 'integer',
        'is_active' => 'boolean',
    ];

    // Orden por defecto
    protected static function booted(): void
    {
        static::addGlobalScope('ordered', function ($q) {
            $q->orderBy('position')->orderBy('id');
        });
    }
}
