<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    public function index()
    {
        $items = Space::query()
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $items,
            'message' => 'Spaces retrieved successfully.',
        ]);
    }

    public function show(Request $request, string $slug)
    {
        $lang = $request->query('lang', 'es');

        $space = Space::query()
            ->where(function ($q) use ($slug) {
                $q->where('slug', $slug)
                    ->orWhere('slug_en', $slug)
                    ->orWhere('slug_fr', $slug);
            })
            ->with(['applications' => function ($q) {
                $q->where('is_active', true)->orderByPivot('order');
            }])
            ->firstOrFail();

        // 👇 Construir SEO personalizado del espacio
        $seo = [
            'meta' => [
                'title' => $space->getMetaTitle($lang),
                'description' => $space->getMetaDescription($lang),
                'keywords' => $space->getMetaKeywords($lang),
                'robots' => 'index, follow',
            ],
            'og' => [
                'title' => $space->getOgTitle($lang),
                'description' => $space->getOgDescription($lang),
                'image' => $space->getOgImageUrl(),
                'type' => 'website',
            ],
            'twitter' => [
                'card' => 'summary_large_image',
                'title' => $space->getOgTitle($lang),
                'description' => $space->getOgDescription($lang),
                'image' => $space->getOgImageUrl(),
            ],
        ];

        $spaceArray = $space->toArray();
        $spaceArray['seo'] = $seo;

        return response()->json([
            'success' => true,
            'data' => $spaceArray,
            'message' => 'Space retrieved successfully.',
        ]);
    }


    public function applications(string $slug)
    {
        $space = Space::query()
            ->where(function ($q) use ($slug) {
                $q->where('slug', $slug)
                    ->orWhere('slug_en', $slug)
                    ->orWhere('slug_fr', $slug);
            })
            ->with(['applications' => function ($q) {
                $q->where('is_active', true)->orderByPivot('order');
            }])
            ->firstOrFail();


        return response()->json([
            'success' => true,
            'data' => $space->applications,
            'message' => 'Space applications retrieved successfully.',
        ]);
    }
}
