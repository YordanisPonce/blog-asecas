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
    // app/Traits/HasSeo.php

    public function syncSeo(array $data): SeoMetadata
    {
        // Limpiar y convertir datos
        $filteredData = [];

        foreach ($data as $key => $value) {
            // 🔧 Manejar arrays (como og_image y twitter_image)
            if (is_array($value)) {
                // Si es un array vacío, convertirlo a null
                if (empty($value)) {
                    $filteredData[$key] = null;
                    \Log::info("Field {$key} was empty array, converted to null");
                }
                // Si es un array con un solo valor, tomar ese valor
                elseif (count($value) === 1 && isset($value[0])) {
                    $filteredData[$key] = $value[0];
                    \Log::info("Field {$key} was array with single value, extracted: " . $value[0]);
                }
                // Si es un array con múltiples valores, tomar el primero
                elseif (count($value) > 1) {
                    $filteredData[$key] = $value[0];
                    \Log::info("Field {$key} was array with multiple values, taking first: " . $value[0]);
                }
                // Para otros casos, convertir a JSON
                else {
                    $filteredData[$key] = json_encode($value);
                    \Log::warning("Field {$key} was complex array, converted to JSON");
                }
            }
            // Filtrar valores null y strings vacías
            elseif (!is_null($value) && $value !== '') {
                $filteredData[$key] = $value;
            }
        }

        \Log::info('syncSeo processed data:', $filteredData);

        try {
            return $this->seo()->updateOrCreate([], $filteredData);
        } catch (\Exception $e) {
            \Log::error('updateOrCreate failed: ' . $e->getMessage());
            throw $e;
        }
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
