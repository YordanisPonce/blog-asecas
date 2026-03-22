<?php
// app/Http/Controllers/Api/CookiesPolicyPageController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CookiesPage;
use Illuminate\Http\Request;

class CookiesPolicyPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = $request->query('lang', 'es');
        abort_unless(in_array($lang, ['es', 'en', 'fr']), 422, 'Invalid lang');

        // Cargar el modelo con su relación SEO
        $page = CookiesPage::with('seo')->first() ?? CookiesPage::create([]);

        $response = [
            'page_title'      => $this->t($page, 'page_title', $lang),
            'last_updated_at' => optional($page->last_updated_at)->toDateString(),

            'columns' => [
                'left' => [
                    ['key' => 'intro',           'html' => $this->t($page, 'intro', $lang)],
                    ['key' => 'collected_info',  'html' => $this->t($page, 'collected_info', $lang)],
                ],
                'right' => [
                    ['key' => 'personal_note',   'html' => $this->t($page, 'personal_data_note', $lang)],
                    ['key' => 'consent',         'html' => $this->t($page, 'consent', $lang)],
                    ['key' => 'disable',         'html' => $this->t($page, 'disable_reject_delete', $lang)],
                ],
            ],

            // 👇 NUEVO: Datos SEO usando el trait
            'seo' => $page->getSeoForApi($lang),
        ];

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'response' => $response,
        ]);
    }

    private function t(CookiesPage $page, string $base, string $lang): ?string
    {
        $field = "{$base}_{$lang}";
        $fallback = "{$base}_es";

        $value = $page->{$field} ?? null;
        if (is_string($value) && trim($value) !== '') {
            return $value;
        }

        return $page->{$fallback} ?? null;
    }
}
