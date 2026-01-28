<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Space extends Model
{
    protected $fillable = [
        'title',
        'title_en',
        'title_fr',
        'slug',
        'slug_en',
        'slug_fr',
        'description',
        'description_en',
        'description_fr',
        'image',
        'image_alt',
        'image_title',
        'seo_title',
        'seo_description',
        'order',
        'is_active',
    ];

    protected $casts = [
        'image_alt' => 'array',
        'image_title' => 'array',
        'seo_title' => 'array',
        'seo_description' => 'array',
        'is_active' => 'boolean',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) return null;

        if (Str::startsWith($this->image, ['http://', 'https://', '//'])) {
            return $this->image;
        }

        // Si existe en storage (disk public), devuelve URL del storage
        if (Storage::disk('public')->exists($this->image)) {
            return Storage::disk('public')->url($this->image);
        }

        // Si NO existe (ej: /img/espacios/...), devuelve tal cual para que Next lo use
        return $this->image;
    }


    // Relación "simple" para API (many-to-many)
    public function applications()
    {
        return $this->belongsToMany(Application::class, 'application_space')
            ->withPivot('order')
            ->withTimestamps()
            ->orderByPivot('order');
    }


    // Relación "admin-friendly" para editar pivot y ordenar
    public function applicationLinks()
    {
        return $this->hasMany(ApplicationSpace::class, 'space_id')->orderBy('order');
    }
}
