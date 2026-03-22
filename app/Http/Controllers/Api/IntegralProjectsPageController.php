<?php
// app/Http/Controllers/Api/IntegralProjectsPageController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IntegralProjectsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IntegralProjectsPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = $request->query('lang', 'es');
        abort_unless(in_array($lang, ['es', 'en', 'fr']), 422, 'Invalid lang');

        // Cargar el modelo con su relación SEO
        $page = IntegralProjectsPage::with('seo')->firstOrCreate(['id' => 1]);

        $t = fn(string $key) => $page->{$key . '_' . $lang} ?: $page->{$key . '_es'} ?: null;

        $url = function (?string $path) {
            if (!$path) return null;
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
            return Storage::disk('public')->url($path);
        };

        $cardsRaw = $page->cards ?? [];

        $cards = collect($cardsRaw)->map(function ($row) use ($lang) {
            $title = $row['title_' . $lang] ?? $row['title_es'] ?? null;
            $text  = $row['text_' . $lang]  ?? $row['text_es']  ?? null;
            return [
                'title' => $title,
                'text' => $text,
                'bullets' => null,
            ];
        })->values();

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
                'cards' => $cards,
                'banner' => [
                    'image' => [
                        'url' => $url($page->banner_image_url),
                        'title' => $t('banner_image_title'),
                        'alt' => $t('banner_image_alt'),
                    ],
                ],
                // 👇 NUEVO: Datos SEO usando el trait
                'seo' => $page->getSeoForApi($lang),
            ],
        ]);
    }
}
