<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BuildersArchitectsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BuildersArchitectsPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = in_array($request->query('lang'), ['es', 'en', 'fr']) ? $request->query('lang') : 'es';

        $page = BuildersArchitectsPage::firstOrCreate(['id' => 1]);

        $t = fn(string $key) => $page->{$key . '_' . $lang} ?: $page->{$key . '_es'} ?: null;

        $url = function (?string $path) {
            if (!$path) return null;
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
            return Storage::disk('public')->url($path);
        };

        // Productos seleccionados (en orden)
        // Productos seleccionados (en orden)
        // Productos seleccionados (en orden)
        $featured = $page->featured_categories ?? [];
        $items = collect();

        // Si por algún motivo viene como JSON string
        if (is_string($featured)) {
            $decoded = json_decode($featured, true);
            $featured = is_array($decoded) ? $decoded : [];
        }

        $featured = collect($featured)->filter(fn($v) => $v !== null && $v !== '')->values()->all();

        if (!empty($featured)) {
            $allNumeric = collect($featured)->every(fn($v) => is_numeric($v));

            if ($allNumeric) {
                // ✅ Compat: si aún guardas IDs
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
                // ✅ Caso actual: guardas SLUGS
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
            'success' => true,
            'data' => [
                // NOTA: estos campos pueden contener HTML si el admin lo escribió así.
                // El front decide si renderiza HTML o texto.
                'hero' => [
                    'title' => $t('hero_title'),
                    'description' => $t('hero_description'),
                    'image' => [
                        'url' => $url($page->hero_image_url),
                        'title' => $t('hero_image_title'),
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
                        'title' => $t('banner_image_title'),
                        'alt' => $t('banner_image_alt'),
                    ],
                ],

                'final' => [
                    'title' => $t('final_title'),
                    'description' => $t('final_description'),
                    'items' => $items,
                ],

                'seo' => [
                    'title' => $t('seo_title'),
                    'description' => $t('seo_description'),
                ],
            ],
        ]);
    }

    public function update(Request $request)
    {
        $page = BuildersArchitectsPage::firstOrCreate(['id' => 1]);
        $page->fill($request->all());
        $page->save();

        return response()->json([
            'success' => true,
            'data' => $page,
            'message' => 'Builders & Architects page updated successfully.',
        ]);
    }
}
