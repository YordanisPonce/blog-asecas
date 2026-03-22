<?php
// app/Http/Controllers/Api/SpacesPageController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SpacesPage;
use App\Models\Space;
use Illuminate\Http\Request;

class SpacesPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = $request->query('lang', 'es');
        abort_unless(in_array($lang, ['es', 'en', 'fr']), 422, 'Invalid lang');

        // Cargar la página con su relación SEO
        $page = SpacesPage::with('seo')->first() ?? SpacesPage::create([]);

        // Helper para obtener valores traducidos
        $t = function (string $key) use ($page, $lang) {
            return $page->{$key . '_' . $lang} ?: $page->{$key . '_es'} ?: null;
        };

        // Obtener los espacios activos
        $spaces = Space::where('is_active', true)
            ->orderBy('order')
            ->get();

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'response' => [
                'page' => [
                    'title' => $t('title'),
                    'description' => $t('description'),
                    'image_url' => $page->image_url,
                    'image_title' => $t('image_title'),
                    'image_alt' => $t('image_alt'),
                ],
                'spaces' => $spaces,
                'seo' => $page->getSeoForApi($lang),
            ],
        ]);
    }
}
