<?php
// app/Http/Controllers/Api/ContactPageController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = $request->query('lang', 'es');
        abort_unless(in_array($lang, ['es', 'en', 'fr']), 422, 'Invalid lang');

        // Cargar el modelo con su relación SEO
        $page = ContactPage::with('seo')->firstOrCreate(['id' => 1]);

        $t = fn(string $key) => $page->{$key . '_' . $lang} ?: $page->{$key . '_es'} ?: null;

        $url = function (?string $path) {
            if (!$path) return null;
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
            return Storage::disk('public')->url($path);
        };

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'response' => [
                'map' => [
                    'embedUrl' => $page->map_embed_url,
                ],

                'contact' => [
                    'title' => $t('contact_title'),
                    'address' => [
                        'line' => $page->address_line,
                        'city' => $page->city,
                        'region' => $page->region,
                        'country' => $page->country,
                    ],
                    'phones' => $page->phones ?? [],
                    'emails' => $page->emails ?? [],
                    'scheduleHtml' => $t('schedule_text'),
                ],

                'form' => [
                    'legalInfoHtml' => $t('legal_info_text'),
                    'checkbox1Label' => $t('checkbox_1_label'),
                    'checkbox2Label' => $t('checkbox_2_label'),
                ],

                'cta' => [
                    'title' => $t('cta_title'),
                    'text' => $t('cta_text'),
                    'buttonText' => $t('cta_button_text'),
                    'buttonUrl' => $page->cta_button_url,
                    'bgImage' => [
                        'url' => $url($page->cta_bg_image),
                        'title' => $page->cta_bg_image_title,
                        'alt' => $page->cta_bg_image_alt,
                    ],
                ],

                'social' => [
                    'linkedin' => $page->social_linkedin,
                    'facebook' => $page->social_facebook,
                    'instagram' => $page->social_instagram,
                    'youtube' => $page->social_youtube,
                ],

                // 👇 NUEVO: Datos SEO usando el trait
                'seo' => $page->getSeoForApi($lang),
            ],
        ]);
    }
}
