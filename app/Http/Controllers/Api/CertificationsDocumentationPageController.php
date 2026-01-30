<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CertificationsDocumentationPage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificationsDocumentationPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = in_array($request->query('lang'), ['es', 'en', 'fr']) ? $request->query('lang') : 'es';

        $page = CertificationsDocumentationPage::firstOrCreate(['id' => 1]);

        $t = fn(string $key) => $page->{$key . '_' . $lang} ?: $page->{$key . '_es'} ?: null;

        $url = function (?string $path) {
            if (!$path) return null;

            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                return $path;
            }

            $path = ltrim($path, '/');

            // si está en public/
            if (is_file(public_path($path))) {
                return asset($path);
            }

            // storage/app/public/*
            return Storage::disk('public')->url($path);
        };

        $documents = collect($page->documents ?? [])
            ->map(function ($doc) use ($lang, $url) {
                $title = $doc['title_' . $lang] ?? $doc['title_es'] ?? null;
                $filePath = $doc['file_path'] ?? null;
                $key = $doc['key'] ?? null;

                return [
                    'key' => $key,
                    'title' => $title,
                    'file' => [
                        'url' => $url($filePath),
                        'path' => $filePath,
                    ],
                    // ✅ camelCase para tu front
                    'downloadUrl' => $key
                        ? url("/api/v1/certificaciones-documentacion/download/{$key}?lang={$lang}")
                        : null,
                ];
            })
            ->values();

        // ✅ featured_categories son SLUGS
        $slugs = $page->featured_categories ?: [];
        $items = collect();

        if (!empty($slugs)) {
            $categoriesBySlug = Category::whereIn('slug', $slugs)->get()->keyBy('slug');

            $items = collect($slugs)
                ->map(fn($slug) => $categoriesBySlug->get($slug))
                ->filter()
                ->map(function ($cat) use ($lang, $url) {
                    $label = $cat->{'name_' . $lang} ?? $cat->name ?? $cat->name_es ?? null;

                    return [
                        'slug'  => $cat->slug,
                        'label' => $label,
                        'image' => $url($cat->image ?? null),
                    ];
                })
                ->values();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'title' => $t('title'),
                'documents' => $documents,
                'solutions' => [
                    'title' => $t('solutions_title'),
                    'description' => $t('solutions_description'),
                    'items' => $items,
                ],
                'seo' => [
                    'title' => $t('seo_title'),
                    'description' => $t('seo_description'),
                ],
            ],
        ]);
    }

    public function download(string $key, Request $request)
    {
        $lang = in_array($request->query('lang'), ['es', 'en', 'fr']) ? $request->query('lang') : 'es';

        $page = CertificationsDocumentationPage::firstOrCreate(['id' => 1]);

        $doc = collect($page->documents ?? [])->first(fn($d) => ($d['key'] ?? null) === $key);

        if (!$doc || empty($doc['file_path'])) {
            return response()->json([
                'success' => false,
                'message' => 'Documento no encontrado',
            ], 404);
        }

        $filePath = ltrim((string) $doc['file_path'], '/');

        // Si te guardaron algo tipo "storage/files/xxx.pdf", lo normalizamos
        if (str_starts_with($filePath, 'storage/')) {
            $filePath = Str::after($filePath, 'storage/');
        }

        // URL externa
        if (str_starts_with($filePath, 'http://') || str_starts_with($filePath, 'https://')) {
            return redirect()->away($filePath);
        }

        $title = $doc['title_' . $lang] ?? $doc['title_es'] ?? 'documento';
        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        $downloadName = Str::slug($title) . ($ext ? ".{$ext}" : '');

        // 1) public/
        if (is_file(public_path($filePath))) {
            return response()->download(public_path($filePath), $downloadName);
        }

        // 2) storage/app/public/
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath, $downloadName);
        }

        return response()->json([
            'success' => false,
            'message' => 'Archivo no encontrado',
        ], 404);
    }
}
