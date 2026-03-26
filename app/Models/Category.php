<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Builder\Function_;
use App\Models\Finish;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'name_en',
        'name_fr',
        'slug',
        'slug_en',
        'slug_fr',
        'image',
        'image_alt',
        'image_title',
        'short_description_en',
        'short_description_es',
        'short_description_fr',
        'description_en',
        'description_es',
        'description_fr',
        'order',
        'is_active',

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
        'is_active' => 'boolean',
    ];

    // Relación many-to-many con Application
    public function applications(): BelongsToMany
    {
        return $this->belongsToMany(Application::class, 'application_category')
            ->withPivot('order')
            ->withTimestamps()
            ->orderByPivot('order');
    }

    // Métodos para traducciones
    public function getTranslatedShortDescriptionAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"short_description_{$locale}"} ?? $this->short_description_en;
    }

    public function getTranslatedDescriptionAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"description_{$locale}"} ?? $this->description_en;
    }

    public function getTranslatedImageAltAttribute()
    {
        $locale = app()->getLocale();
        return $this->image_alt[$locale] ?? $this->image_alt['en'] ?? '';
    }

    public function getTranslatedImageTitleAttribute()
    {
        $locale = app()->getLocale();
        return $this->image_title[$locale] ?? $this->image_title['en'] ?? '';
    }

    // ✅ AGREGAR ESTOS SCOPES QUE FALTABAN
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('categories.order')->orderBy('name');
    }

    public function products()
    {
        return $this->hasMany(Product::class)->ordered();
    }

    public function finishes(): BelongsToMany
    {
        return $this->belongsToMany(Finish::class, 'category_finish')
            ->withTimestamps();
    }

    // Añadir métodos helper para SEO (después de los existentes)
    public function getMetaTitle(string $lang): ?string
    {
        // 1. Intentar obtener el valor SEO específico del idioma
        $seoValue = $this->{"meta_title_{$lang}"};

        // 2. Si existe y no está vacío, devolverlo
        if (!empty($seoValue)) {
            return $seoValue;
        }

        // 3. Si no hay SEO, usar el nombre traducido según el idioma
        // Nota: $this->name es español, $this->name_en es inglés, $this->name_fr es francés
        if ($lang === 'en') {
            return $this->name_en ?? $this->name;
        }

        if ($lang === 'fr') {
            return $this->name_fr ?? $this->name;
        }

        // Español por defecto
        return $this->name;
    }

    public function getMetaDescription(string $lang): ?string
    {
        // 1. Intentar obtener el valor SEO específico del idioma
        $seoValue = $this->{"meta_description_{$lang}"};

        // 2. Si existe y no está vacío, devolverlo
        if (!empty($seoValue)) {
            return $seoValue;
        }

        // 3. Si no hay SEO, usar la short_description traducida según el idioma
        if ($lang === 'en') {
            return $this->short_description_en ?? null;
        }

        if ($lang === 'fr') {
            return $this->short_description_fr ?? $this->short_description_en ?? null;
        }

        // Español por defecto
        return $this->short_description_es ?? $this->short_description_en ?? null;
    }

    public function getMetaKeywords(string $lang): ?string
    {
        return $this->{"meta_keywords_{$lang}"} ?? null;
    }


    public function getOgTitle(string $lang): ?string
    {
        // 1. Intentar obtener OG específico del idioma
        $ogValue = $this->{"og_title_{$lang}"};

        // 2. Si existe, devolverlo
        if (!empty($ogValue)) {
            return $ogValue;
        }

        // 3. Fallback al Meta Title
        return $this->getMetaTitle($lang);
    }

    public function getOgDescription(string $lang): ?string
    {
        // 1. Intentar obtener OG específico del idioma
        $ogValue = $this->{"og_description_{$lang}"};

        // 2. Si existe, devolverlo
        if (!empty($ogValue)) {
            return $ogValue;
        }

        // 3. Fallback al Meta Description
        return $this->getMetaDescription($lang);
    }

    public function getOgImageUrl(): ?string
    {
        if ($this->og_image) {
            return Storage::disk('public')->url($this->og_image);
        }
        return $this->image_url;
    }
}