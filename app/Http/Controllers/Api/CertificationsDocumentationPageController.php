<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CertificationsDocumentationPage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificationsDocumentationPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = in_array($request->query('lang'), ['es', 'en', 'fr']) ? $request->query('lang') : 'es';

        $page = CertificationsDocumentationPage::firstOrCreate(['id' => 1]);

        $t = fn(string $key) => $page->{$key . '_' . $lang} ?: $page->{$key . '_es'} ?: null;

        $url = function (?string $path) {
            if (!$path) return null;
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
            return Storage::disk('public')->url($path);
        };

        // Documents
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
                    // para el botón “Descargar” (forzado)
                    'download_url' => $key ? url("/api/v1/certificaciones-documentacion/download/{$key}?lang={$lang}") : null,
                ];
            })
            ->values();

        // Categorías seleccionadas (en orden)
        $ids = $page->featured_categories ?: [];
        $items = collect();

        if (!empty($ids)) {
            $categoriesById = Category::whereIn('id', $ids)->get()->keyBy('id');

            $items = collect($ids)
                ->map(fn($id) => $categoriesById->get($id))
                ->filter()
                ->map(function ($cat) use ($lang) {
                    $label = $cat->{'name_' . $lang} ?? $cat->name ?? $cat->name_es ?? null;

                    return [
                        'slug'  => $cat->slug,
                        'label' => $label,
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

        $filePath = (string) $doc['file_path'];

        // Si es URL externa, redirige
        if (str_starts_with($filePath, 'http://') || str_starts_with($filePath, 'https://')) {
            return redirect()->away($filePath);
        }

        if (!Storage::disk('public')->exists($filePath)) {
            return response()->json([
                'success' => false,
                'message' => 'Archivo no encontrado en storage',
            ], 404);
        }

        $title = $doc['title_' . $lang] ?? $doc['title_es'] ?? 'documento';
        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        $downloadName = \Illuminate\Support\Str::slug($title) . ($ext ? ".{$ext}" : '');

        return Storage::disk('public')->download($filePath, $downloadName);
    }
}
