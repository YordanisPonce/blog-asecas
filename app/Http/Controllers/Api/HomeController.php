<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function show(Request $request)
    {
        $lang = in_array($request->query('lang'), ['es', 'en', 'fr'])
            ? $request->query('lang')
            : 'es';

        $home = Home::firstOrCreate([]);

        // Helper fallback ES si falta idioma
        $t = fn($key) => $home->{$key . '_' . $lang} ?: $home->{$key . '_es'} ?: null;

        $url = function (?string $path) {
            if (!$path) return null;
            // Si ya es URL completa, la devolvemos igual
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
            return Storage::disk('public')->url($path);
        };

        return response()->json([
            'success' => true,
            'data' => [
                'hero' => [
                    'title' => $t('first_title'),
                    'description' => $t('first_description'),
                    'image' => [
                        'url' => $url($home->first_image_url),
                        'title' => $t('first_image_title'),
                        'alt' => $t('first_image_alt'),
                    ],
                ],
                'about' => [
                    'title' => $t('second_title'),        // “Grupo Estucalia”
                    'description' => $t('second_description'), // “Más de 25 años...”
                ],
                'help' => [
                    'title' => $t('cta_help_title'),
                    'text' => $t('cta_help_text'),
                    'button' => $t('cta_help_button'),
                    'url' => $home->cta_help_url,
                    'image' => [
                        'url' => $url($home->cta_help_image_url),
                        'title' => $t('cta_help_image_title'),
                        'alt' => $t('cta_help_image_alt'),
                    ],
                ],
                'seo' => [
                    'title' => $t('seo_title'),
                    'description' => $t('seo_description'),
                ],
            ],
        ]);
    }

    public function update(Request $request)
    {
        $home = Home::firstOrCreate([]);
        $home->fill($request->all());
        $home->save();

        return response()->json([
            'success' => true,
            'data' => $home,
            'message' => 'Home updated successfully.',
        ]);
    }
}
