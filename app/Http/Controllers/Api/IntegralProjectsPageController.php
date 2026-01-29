<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IntegralProjectsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IntegralProjectsPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = in_array($request->query('lang'), ['es', 'en', 'fr']) ? $request->query('lang') : 'es';

        $page = IntegralProjectsPage::firstOrCreate(['id' => 1]);

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
            'success' => true,
            'data' => [
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

                'cards' => $cards,

                'banner' => [
                    'image' => [
                        'url' => $url($page->banner_image_url),
                        'title' => $t('banner_image_title'),
                        'alt' => $t('banner_image_alt'),
                    ],
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
        $page = IntegralProjectsPage::firstOrCreate(['id' => 1]);
        $page->fill($request->all());
        $page->save();

        return response()->json([
            'success' => true,
            'data' => $page,
            'message' => 'Integral Projects page updated successfully.',
        ]);
    }
}
