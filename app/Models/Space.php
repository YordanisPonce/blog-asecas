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
        // 👇 NUEVOS CAMPOS SEO
        'meta_title_es',
        'meta_title_en',
        'meta_title_fr',
        'meta_description_es',
        'meta_description_en',
        'meta_description_fr',
        'meta_keywords_es',
        'meta_keywords_en',
        'meta_keywords_fr',
        'og_title_es',
        'og_title_en',
        'og_title_fr',
        'og_description_es',
        'og_description_en',
        'og_description_fr',
        'og_image', 
    ];

    protected $casts = [
        'image_alt' => 'array',
        'image_title' => 'array',
        'seo_title' => 'array',
        'seo_description' => 'array',
        'is_active' => 'boolean',
    ];

    protected $appends = ['image_url'];


    // 👇 AÑADIR MÉTODOS HELPER PARA SEO
    public function getMetaTitle(string $lang): ?string
    {
        $seoValue = $this->{"meta_title_{$lang}"};
        if (!empty($seoValue)) {
            return $seoValue;
        }

        if ($lang === 'en') {
            return $this->title_en ?? $this->title;
        }
        if ($lang === 'fr') {
            return $this->title_fr ?? $this->title;
        }
        return $this->title;
    }

    public function getMetaDescription(string $lang): ?string
    {
        $seoValue = $this->{"meta_description_{$lang}"};
        if (!empty($seoValue)) {
            return $seoValue;
        }

        if ($lang === 'en') {
            return $this->description_en ?? null;
        }
        if ($lang === 'fr') {
            return $this->description_fr ?? $this->description_en ?? null;
        }
        return $this->description ?? null;
    }

    public function getMetaKeywords(string $lang): ?string
    {
        return $this->{"meta_keywords_{$lang}"} ?? null;
    }

    public function getOgTitle(string $lang): ?string
    {
        $ogValue = $this->{"og_title_{$lang}"};
        if (!empty($ogValue)) {
            return $ogValue;
        }
        return $this->getMetaTitle($lang);
    }

    public function getOgDescription(string $lang): ?string
    {
        $ogValue = $this->{"og_description_{$lang}"};
        if (!empty($ogValue)) {
            return $ogValue;
        }
        return $this->getMetaDescription($lang);
    }

    public function getOgImageUrl(): ?string
    {
        if ($this->og_image) {
            return Storage::disk('public')->url($this->og_image);
        }
        return $this->image_url;
    }

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
