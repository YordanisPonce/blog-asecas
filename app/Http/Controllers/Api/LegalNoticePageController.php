<?php
// app/Http/Controllers/Api/LegalNoticePageController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use Illuminate\Http\Request;

class LegalNoticePageController extends Controller
{
    public function show(Request $request)
    {
        $lang = $request->query('lang', 'es');
        abort_unless(in_array($lang, ['es', 'en', 'fr']), 422, 'Invalid lang');

        // Cargar el modelo con su relación SEO
        $page = LegalPage::with('seo')->first() ?? LegalPage::create([]);

        // Debug: ver qué tiene el SEO
        \Log::info('LegalPage SEO:', $page->seo ? $page->seo->toArray() : 'No SEO');

        $data = [
            'page_title'      => $this->t($page, 'page_title', $lang),
            'last_updated_at' => optional($page->last_updated_at)->toDateString(),

            'columns' => [
                'left' => [
                    ['key' => 'ident_info',        'html' => $this->t($page, 'ident_info', $lang)],
                    ['key' => 'terms_use',         'html' => $this->t($page, 'terms_use', $lang)],
                    ['key' => 'security_measures', 'html' => $this->t($page, 'security_measures', $lang)],
                ],
                'right' => [
                    ['key' => 'ip_rights',          'html' => $this->t($page, 'ip_rights', $lang)],
                    ['key' => 'warranty_exclusion', 'html' => $this->t($page, 'warranty_exclusion', $lang)],
                    ['key' => 'modifications',      'html' => $this->t($page, 'modifications', $lang)],
                    ['key' => 'applicable_law',     'html' => $this->t($page, 'applicable_law', $lang)],
                ],
            ],

            // 👇 Datos SEO usando el trait
            'seo' => $page->getSeoForApi($lang),
        ];

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'response' => $data,
        ]);
    }

    private function t(LegalPage $page, string $base, string $lang): ?string
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
