<?php
// app/Models/SeoMetadata.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SeoMetadata extends Model
{
    protected $table = 'seo_metadata';

    protected $fillable = [
        'seoable_type',
        'seoable_id',
        // Meta tags básicos
        'meta_title_es',
        'meta_title_en',
        'meta_title_fr',
        'meta_description_es',
        'meta_description_en',
        'meta_description_fr',
        'meta_keywords_es',
        'meta_keywords_en',
        'meta_keywords_fr',
        'meta_robots',
        'meta_author',
        'meta_publisher',
        'canonical_url',
        // Open Graph
        'og_title_es',
        'og_title_en',
        'og_title_fr',
        'og_description_es',
        'og_description_en',
        'og_description_fr',
        'og_image',
        'og_type',
        // Twitter
        'twitter_card',
        'twitter_title_es',
        'twitter_title_en',
        'twitter_title_fr',
        'twitter_description_es',
        'twitter_description_en',
        'twitter_description_fr',
        'twitter_image',
    ];

    protected $casts = [
        'meta_robots' => 'string',
        'og_type' => 'string',
        'twitter_card' => 'string',
    ];

    /**
     * Relación polimórfica inversa
     */
    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Obtener título según idioma
     */
    public function getMetaTitle(string $lang = 'es'): ?string
    {
        return $this->{"meta_title_{$lang}"} ?: $this->meta_title_es;
    }

    /**
     * Obtener descripción según idioma
     */
    public function getMetaDescription(string $lang = 'es'): ?string
    {
        return $this->{"meta_description_{$lang}"} ?: $this->meta_description_es;
    }

    /**
     * Obtener keywords según idioma
     */
    public function getMetaKeywords(string $lang = 'es'): ?string
    {
        return $this->{"meta_keywords_{$lang}"} ?: $this->meta_keywords_es;
    }

    /**
     * Obtener Open Graph title según idioma
     */
    public function getOgTitle(string $lang = 'es'): ?string
    {
        return $this->{"og_title_{$lang}"} ?: $this->getMetaTitle($lang);
    }

    /**
     * Obtener Open Graph description según idioma
     */
    public function getOgDescription(string $lang = 'es'): ?string
    {
        return $this->{"og_description_{$lang}"} ?: $this->getMetaDescription($lang);
    }

    /**
     * Obtener Twitter title según idioma
     */
    public function getTwitterTitle(string $lang = 'es'): ?string
    {
        return $this->{"twitter_title_{$lang}"} ?: $this->getMetaTitle($lang);
    }

    /**
     * Obtener Twitter description según idioma
     */
    public function getTwitterDescription(string $lang = 'es'): ?string
    {
        return $this->{"twitter_description_{$lang}"} ?: $this->getMetaDescription($lang);
    }
}
