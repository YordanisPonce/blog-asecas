<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    protected $fillable = [
        'image_path',
        'slug',
        'position',
        'is_active',
        'title_es',
        'title_en',
        'title_fr',
        'description_es',
        'description_en',
        'description_fr',
        'subdescription_es',
        'subdescription_en',
        'subdescription_fr',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'position' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $model) {
            // si no viene slug, lo generamos con title_es (o el que exista)
            if (blank($model->slug)) {
                $base = $model->title_es ?? $model->title_en ?? $model->title_fr ?? Str::uuid()->toString();
                $slug = Str::slug(Str::limit($base, 60, ''));
                // asegurar unicidad simple
                $original = $slug;
                $i = 1;
                while (static::where('slug', $slug)->when($model->exists, fn($q) => $q->where('id', '!=', $model->id))->exists()) {
                    $slug = "{$original}-{$i}";
                    $i++;
                }
                $model->slug = $slug;
            }
        });
    }
}
