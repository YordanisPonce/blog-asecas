<?php
// app/Models/Inspiration.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    protected $appends = ['image_url'];

    protected static function booted(): void
    {
        static::addGlobalScope('ordered', function ($q) {
            $q->orderBy('position')->orderBy('id');
        });
    }

    // ✅ Scope para API
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ✅ URL final (como Finish)
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            return Storage::disk('public')->url($this->image_path);
        }
        return $this->image_path; // fallback por si ya viene una url
    }
}
