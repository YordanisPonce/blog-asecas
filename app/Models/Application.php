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
    ];

    protected $casts = [
        'image_alt' => 'array',
        'image_title' => 'array',
        'is_active' => 'boolean',
    ];

    protected $appends = ['icon_url'];
    // Relación many-to-many con Category
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'application_category')
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

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('applications.order')->orderBy('name');
    }

    public function getIconUrlAttribute()
    {
        return Storage::disk('public')->url($this->icon);
    }

}