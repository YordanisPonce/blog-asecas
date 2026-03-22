<?php
// app/Http/Controllers/Api/FinishesPageController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FinishesPage;
use App\Models\Finish;
use Illuminate\Http\Request;

class FinishesPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = $request->query('lang', 'es');
        abort_unless(in_array($lang, ['es', 'en', 'fr']), 422, 'Invalid lang');

        // Cargar la página con su relación SEO
        $page = FinishesPage::with('seo')->first() ?? FinishesPage::create([]);

        // Helper para obtener valores traducidos
        $t = function (string $key) use ($page, $lang) {
            return $page->{$key . '_' . $lang} ?: $page->{$key . '_es'} ?: null;
        };

        // Obtener los acabados activos
        $finishes = Finish::with([
            'categories' => fn($q) => $q->active()->ordered()
        ])
            ->active()
            ->ordered()
            ->get();

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'response' => [
                'page' => [
                    'title' => $t('page_title'),
                    'intro' => $t('intro'),
                    'finishes_items' => $page->finishes_items ?? [],
                ],
                'finishes' => $finishes,
                'seo' => $page->getSeoForApi($lang),
            ],
        ]);
    }
}
