<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPage;
use Illuminate\Http\Request;

class PrivacyPolicyPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = strtolower((string) $request->query('lang', 'es'));
        if (!in_array($lang, ['es', 'en', 'fr'], true)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid lang. Allowed: es, en, fr',
            ], 422);
        }

        $page = PrivacyPage::query()->first() ?? PrivacyPage::create([]);

        $data = [
            'page_title'      => $this->t($page, 'page_title', $lang),
            'last_updated_at' => optional($page->last_updated_at)->toDateString(),

            // Para render en 2 columnas como tu diseño
            'columns' => [
                'left' => [
                    ['key' => 'intro',             'html' => $this->t($page, 'intro', $lang)],
                    ['key' => 'controller_info',   'html' => $this->t($page, 'controller_info', $lang)],
                    ['key' => 'purpose',           'html' => $this->t($page, 'purpose', $lang)],
                    ['key' => 'legal_basis',       'html' => $this->t($page, 'legal_basis', $lang)],
                    ['key' => 'security_measures', 'html' => $this->t($page, 'security_measures', $lang)],
                    ['key' => 'modifications',     'html' => $this->t($page, 'modifications', $lang)],
                ],
                'right' => [
                    ['key' => 'data_sharing',    'html' => $this->t($page, 'data_sharing', $lang)],
                    ['key' => 'intl_transfers',  'html' => $this->t($page, 'intl_transfers', $lang)],
                    ['key' => 'retention',       'html' => $this->t($page, 'retention', $lang)],
                    ['key' => 'rights_howto',    'html' => $this->t($page, 'rights_howto', $lang)],
                ],
            ],

            'seo' => [
                'title'       => $this->t($page, 'seo_title', $lang),
                'description' => $this->t($page, 'seo_description', $lang),
            ],
        ];

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'response' => $data,
        ]);
    }

    private function t(PrivacyPage $page, string $base, string $lang): ?string
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
