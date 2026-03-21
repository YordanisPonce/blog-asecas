<?php
// app/Traits/HasSeo.php

namespace App\Traits;

use App\Models\SeoMetadata;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasSeo
{
    /**
     * Relación uno a uno polimórfica con SEO
     */
    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'seoable');
    }

    /**
     * Obtener el registro SEO o crear uno vacío
     * Útil para formularios de Filament
     */
    public function getSeoOrCreate(): SeoMetadata
    {
        return $this->seo()->firstOrCreate([]);
    }

    /**
     * Sincronizar datos SEO (guardar o actualizar)
     */
    public function syncSeo(array $data): SeoMetadata
    {
        // Limpiar datos vacíos para no guardar basura
        $data = array_filter($data, function ($value) {
            return !is_null($value) && $value !== '';
        });

        return $this->seo()->updateOrCreate([], $data);
    }

    /**
     * Obtener datos SEO formateados para API
     */
    public function getSeoForApi(string $lang = 'es'): ?array
    {
        if (!$this->seo) {
            return null;
        }

        return [
            'meta' => [
                'title' => $this->seo->getMetaTitle($lang),
                'description' => $this->seo->getMetaDescription($lang),
                'keywords' => $this->seo->getMetaKeywords($lang),
                'robots' => $this->seo->meta_robots,
                'author' => $this->seo->meta_author,
                'publisher' => $this->seo->meta_publisher,
                'canonical' => $this->seo->canonical_url,
            ],
            'og' => [
                'title' => $this->seo->getOgTitle($lang),
                'description' => $this->seo->getOgDescription($lang),
                'image' => $this->seo->og_image ? url('/storage/' . $this->seo->og_image) : null,
                'type' => $this->seo->og_type,
            ],
            'twitter' => [
                'card' => $this->seo->twitter_card,
                'title' => $this->seo->getTwitterTitle($lang),
                'description' => $this->seo->getTwitterDescription($lang),
                'image' => $this->seo->twitter_image ? url('/storage/' . $this->seo->twitter_image) : null,
            ],
        ];
    }
}
