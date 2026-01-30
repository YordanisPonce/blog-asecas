<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WorkWithUsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkWithUsPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = in_array($request->query('lang'), ['es', 'en', 'fr']) ? $request->query('lang') : 'es';

        $page = WorkWithUsPage::firstOrCreate(['id' => 1]);

        $t = fn(string $key) => $page->{$key . '_' . $lang} ?: $page->{$key . '_es'} ?: null;

        $url = function (?string $path) {
            if (!$path) return null;

            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                return $path;
            }

            // ✅ si existe en /public (ej: public/work-with-us/xxx.png)
            if (file_exists(public_path($path))) {
                return asset($path);
            }

            // ✅ fallback a storage/app/public
            return Storage::disk('public')->url($path);
        };


        return response()->json([
            'success' => true,
            'data' => [
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

                'seo' => [
                    'title' => $t('seo_title'),
                    'description' => $t('seo_description'),
                ],
            ],
        ]);
    }
}
