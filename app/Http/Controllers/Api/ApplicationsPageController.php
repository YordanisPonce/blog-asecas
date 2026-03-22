<?php
// app/Http/Controllers/Api/ApplicationsPageController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApplicationsPage;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationsPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = $request->query('lang', 'es');
        abort_unless(in_array($lang, ['es', 'en', 'fr']), 422, 'Invalid lang');

        // Cargar la página con su relación SEO
        $page = ApplicationsPage::with('seo')->first() ?? ApplicationsPage::create([]);

        // Obtener las aplicaciones activas (esto ya lo tenías)
        $applications = Application::with([
            'categories' => function ($query) {
                $query->select('categories.id', 'categories.name', 'categories.slug', 'categories.image')
                    ->where('is_active', true)
                    ->orderBy('categories.order');
            }
        ])
            ->active()
            ->ordered()
            ->get();

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'response' => [
                'applications' => $applications,
                'seo' => $page->getSeoForApi($lang),
            ],
        ]);
    }
}
