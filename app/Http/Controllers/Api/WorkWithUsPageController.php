<?php
// app/Http/Controllers/Api/WorkWithUsPageController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WorkWithUsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkWithUsPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = $request->query('lang', 'es');
        abort_unless(in_array($lang, ['es', 'en', 'fr']), 422, 'Invalid lang');

        // Cargar el modelo con su relación SEO
        $page = WorkWithUsPage::with('seo')->firstOrCreate(['id' => 1]);

        $t = function (string $key) use ($page, $lang) {
            return $page->{$key . '_' . $lang} ?: $page->{$key . '_es'} ?: null;
        };

        $url = function (?string $path) {
            if (!$path) return null;
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                return $path;
            }
            if (file_exists(public_path($path))) {
                return asset($path);
            }
            return Storage::disk('public')->url($path);
        };

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'response' => [
                'hero' => [
                    'title' => $t('hero_title'),
                    'bgImage' => [
                        'url' => $url($page->hero_bg_image),
                        'title' => null,
                        'alt' => $t('hero_title'),
                    ],
                ],

                'section' => [
                    'title' => $t('section_title'),
                    'text' => $t('section_text'),
                ],

                'form' => [
                    'fields' => [
                        'name' => $t('field_name_label'),
                        'phone' => $t('field_phone_label'),
                        'email' => $t('field_email_label'),
                        'speciality' => $t('field_speciality_label'),
                        'message' => $t('field_message_label'),
                    ],
                    'cvLabel' => $t('cv_label'),
                    'submitText' => $t('submit_text'),
                    'legalInfoHtml' => $t('legal_info_text'),
                    'checkbox1Label' => $t('checkbox_1_label'),
                    'checkbox2Label' => $t('checkbox_2_label'),
                ],

                // 👇 NUEVO: Datos SEO usando el trait
                'seo' => $page->getSeoForApi($lang),
            ],
        ]);
    }
}
