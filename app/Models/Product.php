<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_en',
        'name_fr',
        'slug',
        'slug_en',
        'slug_fr',
        'category_id',
        'subtitle',
        'image',
        'image_alt',
        'image_title',
        'composition_en',
        'composition_es',
        'composition_fr',
        'features_en',
        'features_es',
        'features_fr',
        'recommendations_en',
        'recommendations_es',
        'recommendations_fr',
        'carriers_en',
        'carriers_es',
        'carriers_fr',
        'relevant_info_en',
        'relevant_info_es',
        'relevant_info_fr',
        'presentation',
        'pallet_info',
        'storage_info',
        'order',
        'is_active',
    ];

    protected $casts = [
        'image_alt' => 'array',
        'image_title' => 'array',
        'is_active' => 'boolean',
    ];

    // Relación con categoría
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Relación con documentos
    public function documents(): HasMany
    {
        return $this->hasMany(ProductDocument::class)->orderBy('order');
    }

    // Métodos para traducciones
    public function getTranslatedCompositionAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"composition_{$locale}"} ?? $this->composition_en;
    }

    public function getTranslatedFeaturesAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"features_{$locale}"} ?? $this->features_en;
    }

    public function getTranslatedRecommendationsAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"recommendations_{$locale}"} ?? $this->recommendations_en;
    }

    public function getTranslatedCarriersAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"carriers_{$locale}"} ?? $this->carriers_en;
    }

    public function getTranslatedRelevantInfoAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"relevant_info_{$locale}"} ?? $this->relevant_info_en;
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

    // Formatear features como array
    public function getFeaturesArrayAttribute()
    {
        $features = $this->translated_features;
        return $features ? array_filter(array_map('trim', explode('-', $features))) : [];
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

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}