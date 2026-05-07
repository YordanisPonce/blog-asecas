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

    /**
     * Limpia HTML y espacios sobrantes para usar un texto en meta tags.
     * Devuelve null si queda vacío (para que el siguiente fallback funcione).
     */
    private static function cleanSeoText(?string $value): ?string
    {
        if ($value === null) return null;
        $clean = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($value), ENT_QUOTES | ENT_HTML5)));
        return $clean !== '' ? $clean : null;
    }

    public function getMetaTitle(string $lang): ?string
    {
        // 1. Intentar obtener el valor SEO específico del idioma
        $seoValue = $this->{"meta_title_{$lang}"};

        // 2. Si existe y no está vacío, devolverlo tal cual
        if (!empty($seoValue)) {
            return $seoValue;
        }

        // 3. Fallback: usar el nombre traducido según el idioma. Si los `name_*`
        // traen HTML (los usa el frontend para renderizar <h1>), aquí lo
        // limpiamos para que el meta tag salga en texto plano.
        $name = match ($lang) {
            'en' => $this->name_en ?? $this->name,
            'fr' => $this->name_fr ?? $this->name,
            default => $this->name,
        };
        return self::cleanSeoText($name);
    }

    public function getMetaDescription(string $lang): ?string
    {
        // 1. Intentar obtener el valor SEO específico del idioma
        $seoValue = $this->{"meta_description_{$lang}"};

        // 2. Si existe y no está vacío, devolverlo
        if (!empty($seoValue)) {
            return $seoValue;
        }

        // 3. Fallback a short_description traducida (limpiando HTML por si acaso).
        $desc = match ($lang) {
            'en' => $this->short_description_en,
            'fr' => $this->short_description_fr ?? $this->short_description_en,
            default => $this->short_description_es ?? $this->short_description_en,
        };
        return self::cleanSeoText($desc);
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