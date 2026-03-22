<?php
// app/Http/Controllers/Api/ApplicatorsPageController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApplicatorsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicatorsPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = $request->query('lang', 'es');
        abort_unless(in_array($lang, ['es', 'en', 'fr']), 422, 'Invalid lang');

        // Cargar el modelo con su relación SEO
        $page = ApplicatorsPage::with('seo')->firstOrCreate(['id' => 1]);

        $t = fn(string $key) => $page->{$key . '_' . $lang} ?: $page->{$key . '_es'} ?: null;

        $url = function (?string $path) {
            if (!$path) return null;
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
            return Storage::disk('public')->url($path);
        };

        $benefits = collect($page->benefits ?? [])
            ->map(function ($item) use ($lang) {
                $title = $item['title_' . $lang] ?? $item['title_es'] ?? null;
                $text  = $item['text_' . $lang]  ?? $item['text_es']  ?? null;

                return [
                    'title' => $title,
                    'text'  => $text,
                ];
            })
            ->filter(fn($x) => $x['title'] || $x['text'])
            ->values()
            ->all();

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
                    ['title' => $t('col1_title'), 'text' => $t('col1_text'), 'bullets' => $t('col1_bullets')],
                    ['title' => $t('col2_title'), 'text' => $t('col2_text'), 'bullets' => $t('col2_bullets')],
                    ['title' => $t('col3_title'), 'text' => $t('col3_text'), 'bullets' => $t('col3_bullets')],
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
                    'benefits' => $benefits,
                    'form' => [
                        'privacy' => $t('form_privacy'),
                        'checkbox1' => $t('form_checkbox1'),
                        'checkbox2' => $t('form_checkbox2'),
                    ],
                ],
                // 👇 NUEVO: Datos SEO usando el trait
                'seo' => $page->getSeoForApi($lang),
            ],
        ]);
    }
}
