<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpresaPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = $request->query('lang', 'es');
        abort_unless(in_array($lang, ['es', 'en', 'fr']), 422, 'Invalid lang');

        $page = Empresa::firstOrCreate(['id' => 1]);

        // featured categories (preservar orden)
        // featured categories (preservar orden) => soporta IDs o SLUGs
        $raw = $page->featured_categories_items ?? [];

        $ids = [];
        $slugs = [];

        foreach ((array) $raw as $item) {
            // Caso 1: viene como [{category_id: 1}, ...]
            if (is_array($item) && isset($item['category_id'])) {
                $v = $item['category_id'];
                if (is_numeric($v)) {
                    $ids[] = (int) $v;
                } elseif (is_string($v) && $v !== '') {
                    $slugs[] = $v;
                }
                continue;
            }

            // Caso 2: viene como ["single-layer-mortar", ...] o ["12", ...]
            if (is_string($item) || is_int($item)) {
                $v = (string) $item;
                if ($v === '') continue;

                if (ctype_digit($v)) {
                    $ids[] = (int) $v;
                } else {
                    $slugs[] = $v;
                }
            }
        }

        $featuredCategories = [];

        // 1) Resolver por ID (preservando orden)
        if (count($ids)) {
            $rowsById = Category::whereIn('id', $ids)->get()->keyBy('id');

            $featuredCategories = array_merge(
                $featuredCategories,
                collect($ids)
                    ->map(fn($id) => $rowsById->get($id))
                    ->filter()
                    ->map(function ($cat) use ($lang) {
                        return [
                            'id' => $cat->id,
                            'name' => $this->t($cat, 'name', $lang) ?? ($cat->name ?? null),
                            'slug' => $cat->slug ?? null,
                            'image' => isset($cat->image) ? $this->img($cat->image) : null,
                        ];
                    })
                    ->values()
                    ->all()
            );
        }

        // 2) Resolver por SLUG (preservando orden) + evitar duplicados si vino también por ID
        if (count($slugs)) {
            $rowsBySlug = Category::whereIn('slug', $slugs)->get()->keyBy('slug');

            $existingSlugs = collect($featuredCategories)->pluck('slug')->filter()->all();

            $featuredCategories = array_merge(
                $featuredCategories,
                collect($slugs)
                    ->map(fn($slug) => $rowsBySlug->get($slug))
                    ->filter()
                    ->reject(fn($cat) => in_array($cat->slug, $existingSlugs, true))
                    ->map(function ($cat) use ($lang) {
                        return [
                            'id' => $cat->id,
                            'name' => $this->t($cat, 'name', $lang) ?? ($cat->name ?? null),
                            'slug' => $cat->slug ?? null,
                            'image' => isset($cat->image) ? $this->img($cat->image) : null,
                        ];
                    })
                    ->values()
                    ->all()
            );
        }


        // logos normalizados (FileUpload => path => URL)
        $logos = collect($page->certs_logos ?? [])
            ->map(function ($l) {
                $logoPath = $l['logo_url'] ?? null;

                return [
                    'logo_url' => $this->img(is_string($logoPath) ? $logoPath : null),
                    'title' => $l['title'] ?? null,
                    'alt' => $l['alt'] ?? null,
                ];
            })
            ->values()
            ->all();

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'response' => [
                // HERO
                'hero_title_es' => $page->hero_title_es,
                'hero_title_en' => $page->hero_title_en,
                'hero_title_fr' => $page->hero_title_fr,
                'hero_video_url' => $page->hero_video_url,
                'hero_image' => $this->img($page->hero_image),
                'hero_image_title' => $page->hero_image_title,
                'hero_image_alt' => $page->hero_image_alt,

                // ABOUT
                'about_title_es' => $page->about_title_es,
                'about_title_en' => $page->about_title_en,
                'about_title_fr' => $page->about_title_fr,
                'about_text_es' => $page->about_text_es,
                'about_text_en' => $page->about_text_en,
                'about_text_fr' => $page->about_text_fr,
                'about_illustration' => $this->img($page->about_illustration),
                'about_illustration_title' => $page->about_illustration_title,
                'about_illustration_alt' => $page->about_illustration_alt,

                // MISSION
                'mission_title_es' => $page->mission_title_es,
                'mission_title_en' => $page->mission_title_en,
                'mission_title_fr' => $page->mission_title_fr,
                'mission_text_es' => $page->mission_text_es,
                'mission_text_en' => $page->mission_text_en,
                'mission_text_fr' => $page->mission_text_fr,

                // PRODUCTION
                'production_title_es' => $page->production_title_es,
                'production_title_en' => $page->production_title_en,
                'production_title_fr' => $page->production_title_fr,
                'production_text_es' => $page->production_text_es,
                'production_text_en' => $page->production_text_en,
                'production_text_fr' => $page->production_text_fr,

                // VIDEO INTERMEDIO
                'solutions_video_url' => $page->solutions_video_url,

                // SOLUTIONS
                'solutions_title_es' => $page->solutions_title_es,
                'solutions_title_en' => $page->solutions_title_en,
                'solutions_title_fr' => $page->solutions_title_fr,
                'solutions_intro_es' => $page->solutions_intro_es,
                'solutions_intro_en' => $page->solutions_intro_en,
                'solutions_intro_fr' => $page->solutions_intro_fr,

                // ids seleccionados en Filament (por si los necesitas)
                'featured_categories_items' => $page->featured_categories_items ?? [],

                // ✅ lo que necesita tu SolutionsSection (slug + label)
                'featured_categories' => collect($featuredCategories)->map(function ($c) {
                    return [
                        'slug' => $c['slug'] ?? null,
                        'label' => $c['name'] ?? null,
                    ];
                })->values(),


                // INTERNATIONAL
                'international_title_es' => $page->international_title_es,
                'international_title_en' => $page->international_title_en,
                'international_title_fr' => $page->international_title_fr,
                'international_text_es' => $page->international_text_es,
                'international_text_en' => $page->international_text_en,
                'international_text_fr' => $page->international_text_fr,
                'international_image' => $this->img($page->international_image),
                'international_image_title' => $page->international_image_title,
                'international_image_alt' => $page->international_image_alt,

                // CERTS
                'certs_title_es' => $page->certs_title_es,
                'certs_title_en' => $page->certs_title_en,
                'certs_title_fr' => $page->certs_title_fr,
                'certs_text_es' => $page->certs_text_es,
                'certs_text_en' => $page->certs_text_en,
                'certs_text_fr' => $page->certs_text_fr,
                'certs_cta_text_es' => $page->certs_cta_text_es,
                'certs_cta_text_en' => $page->certs_cta_text_en,
                'certs_cta_text_fr' => $page->certs_cta_text_fr,
                'certs_cta_url' => $page->certs_cta_url,
                'certs_logos' => collect($page->certs_logos ?? [])->map(function ($l) {
                    return [
                        'logo_url' => $this->img($l['logo_url'] ?? null),
                        'title' => $l['title'] ?? null,
                        'alt' => $l['alt'] ?? null,
                    ];
                })->values(),

                // CONSULTING
                'consulting_title_es' => $page->consulting_title_es,
                'consulting_title_en' => $page->consulting_title_en,
                'consulting_title_fr' => $page->consulting_title_fr,
                'consulting_text_es' => $page->consulting_text_es,
                'consulting_text_en' => $page->consulting_text_en,
                'consulting_text_fr' => $page->consulting_text_fr,
                'consulting_cta_text_es' => $page->consulting_cta_text_es,
                'consulting_cta_text_en' => $page->consulting_cta_text_en,
                'consulting_cta_text_fr' => $page->consulting_cta_text_fr,
                'consulting_cta_url' => $page->consulting_cta_url,
                'consulting_bg_image' => $this->img($page->consulting_bg_image),
                'consulting_bg_image_title' => $page->consulting_bg_image_title,
                'consulting_bg_image_alt' => $page->consulting_bg_image_alt,

                // BOTTOM
                'bottom_bg_image' => $this->img($page->bottom_bg_image),
                'bottom_bg_image_title' => $page->bottom_bg_image_title,
                'bottom_bg_image_alt' => $page->bottom_bg_image_alt,
            ],
        ]);
    }

    private function t($model, string $base, string $lang): ?string
    {
        $col = "{$base}_{$lang}";
        $fallback = "{$base}_es";
        return $model->{$col} ?: $model->{$fallback};
    }

    private function img(?string $path): ?string
    {
        if (!$path) return null;
        if (preg_match('/^https?:\/\//i', $path)) return $path;
        return Storage::disk('public')->url($path);
    }
}
