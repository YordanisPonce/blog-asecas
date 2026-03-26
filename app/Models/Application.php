<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_en',
        'name_fr',
        'slug',
        'slug_en',
        'slug_fr',
        'icon',
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
        'is_active' => 'boolean',
    ];

    protected $appends = ['image_url', 'icon_url'];

    // 👇 AÑADIR MÉTODOS HELPER PARA SEO
    public function getMetaTitle(string $lang): ?string
    {
        $seoValue = $this->{"meta_title_{$lang}"};
        if (!empty($seoValue)) {
            return $seoValue;
        }

        if ($lang === 'en') {
            return $this->name_en ?? $this->name;
        }
        if ($lang === 'fr') {
            return $this->name_fr ?? $this->name;
        }
        return $this->name;
    }

    public function getMetaDescription(string $lang): ?string
    {
        $seoValue = $this->{"meta_description_{$lang}"};
        if (!empty($seoValue)) {
            return $seoValue;
        }

        if ($lang === 'en') {
            return $this->short_description_en ?? null;
        }
        if ($lang === 'fr') {
            return $this->short_description_fr ?? $this->short_description_en ?? null;
        }
        return $this->short_description_es ?? $this->short_description_en ?? null;
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
    
    // Relación many-to-many con Category
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'application_category')
            ->withPivot('order')
            ->withTimestamps()
            ->orderByPivot('order');
    }

    public function spaces(): BelongsToMany
    {
        return $this->belongsToMany(Space::class, 'application_space')
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

    public function getImageUrlAttribute()
    {
        if (!$this->image) return null;

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        if (Storage::disk('public')->exists($this->image)) {
            return Storage::disk('public')->url($this->image);
        }

        return $this->image; // fallback
    }


    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }



    public function getIconUrlAttribute()
    {
        if (!$this->icon) return null;

        if (str_starts_with($this->icon, 'http://') || str_starts_with($this->icon, 'https://')) {
            return $this->icon;
        }

        if (Storage::disk('public')->exists($this->icon)) {
            return Storage::disk('public')->url($this->icon);
        }

        return $this->icon; // fallback
    }

}