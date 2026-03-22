<?php
// app/Http/Controllers/Api/BuildersArchitectsPageController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BuildersArchitectsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BuildersArchitectsPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = $request->query('lang', 'es');
        abort_unless(in_array($lang, ['es', 'en', 'fr']), 422, 'Invalid lang');

        // Cargar el modelo con su relación SEO
        $page = BuildersArchitectsPage::with('seo')->firstOrCreate(['id' => 1]);

        $t = fn(string $key) => $page->{$key . '_' . $lang} ?: $page->{$key . '_es'} ?: null;

        $url = function (?string $path) {
            if (!$path) return null;
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
            return Storage::disk('public')->url($path);
        };

        // Productos seleccionados (en orden)
        $featured = $page->featured_categories ?? [];
        $items = collect();

        if (is_string($featured)) {
            $decoded = json_decode($featured, true);
            $featured = is_array($decoded) ? $decoded : [];
        }

        $featured = collect($featured)->filter(fn($v) => $v !== null && $v !== '')->values()->all();

        if (!empty($featured)) {
            $allNumeric = collect($featured)->every(fn($v) => is_numeric($v));

            if ($allNumeric) {
                $categoriesById = \App\Models\Category::whereIn('id', $featured)->get()->keyBy('id');

                $items = collect($featured)
                    ->map(fn($id) => $categoriesById->get((int) $id))
                    ->filter()
                    ->map(function ($cat) use ($lang) {
                        $label = $cat->{'name_' . $lang} ?? $cat->name ?? $cat->name_es ?? null;
                        $slug  = $cat->{'slug_' . $lang} ?? $cat->slug;

                        return [
                            'slug'  => $slug,
                            'label' => $label,
                        ];
                    })
                    ->values();
            } else {
                $categoriesBySlug = \App\Models\Category::whereIn('slug', $featured)->get()->keyBy('slug');

                $items = collect($featured)
                    ->map(fn($slug) => $categoriesBySlug->get($slug))
                    ->filter()
                    ->map(function ($cat) use ($lang) {
                        $label = $cat->{'name_' . $lang} ?? $cat->name ?? $cat->name_es ?? null;
                        $slug  = $cat->{'slug_' . $lang} ?? $cat->slug;

                        return [
                            'slug'  => $slug,
                            'label' => $label,
                        ];
                    })
                    ->values();
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'response' => [
                'hero' => [
                    'title' => $t('hero_title'),
                    'image' => [
                        'url' => $url($page->hero_image_url),
                        'alt' => $t('hero_image_alt'),
                    ],
                ],

                'columns' => [
                    [
                        'title' => $t('col1_title'),
                        'text' => $t('col1_text'),
                        'bullets' => $t('col1_bullets'),
                    ],
                    [
                        'title' => $t('col2_title'),
                        'text' => $t('col2_text'),
                        'bullets' => $t('col2_bullets'),
                    ],
                    [
                        'title' => $t('col3_title'),
                        'text' => $t('col3_text'),
                        'bullets' => $t('col3_bullets'),
                    ],
                ],

                'banner' => [
                    'image' => [
                        'url' => $url($page->banner_image_url),
                        'alt' => $t('banner_image_alt'),
                    ],
                ],

                'final' => [
                    'title' => $t('final_title'),
                    'description' => $t('final_description'),
                    'items' => $items,
                ],

                // 👇 NUEVO: Datos SEO usando el trait
                'seo' => $page->getSeoForApi($lang),
            ],
        ]);
    }
}
