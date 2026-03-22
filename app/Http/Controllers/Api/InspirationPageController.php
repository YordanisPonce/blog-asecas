<?php
// app/Http/Controllers/Api/InspirationPageController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inspiration;
use App\Models\InspirationPage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InspirationPageController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $lang = $request->query('lang', 'es');
        abort_unless(in_array($lang, ['es', 'en', 'fr']), 422, 'Invalid lang');

        // Cargar la página con su relación SEO
        $page = InspirationPage::with('seo')->firstOrCreate([]);

        $limit = (int) $request->query('limit', 0);
        if ($limit <= 0) {
            $limit = (int) ($page->default_limit ?? 0);
        }

        $q = Inspiration::query()->active();

        if ($limit > 0) {
            $q->limit($limit);
        }

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'response' => [
                'page' => [
                    'title_es' => $page->title_es,
                    'title_en' => $page->title_en,
                    'title_fr' => $page->title_fr,
                    'description_es' => $page->description_es,
                    'description_en' => $page->description_en,
                    'description_fr' => $page->description_fr,
                    'default_limit' => $page->default_limit,
                ],
                'items' => $q->get(),
                // 👇 NUEVO: Datos SEO usando el trait
                'seo' => $page->getSeoForApi($lang),
            ],
        ]);
    }
}
