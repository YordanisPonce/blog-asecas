<?php
// app/Http/Controllers/Api/CategoriesPageController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoriesPage;
use Illuminate\Http\Request;

class CategoriesPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = $request->query('lang', 'es');
        abort_unless(in_array($lang, ['es', 'en', 'fr']), 422, 'Invalid lang');

        // Cargar la página con su relación SEO
        $page = CategoriesPage::with('seo')->first() ?? CategoriesPage::create([]);

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'response' => [
                'seo' => $page->getSeoForApi($lang),
            ],
        ]);
    }
}
