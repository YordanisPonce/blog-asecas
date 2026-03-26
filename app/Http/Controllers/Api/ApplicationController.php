<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of applications.
     */
    public function index(): JsonResponse
    {
        $applications = Application::with([
            'categories' => function ($query) {
                $query->select('categories.id', 'categories.name', 'categories.slug', 'categories.image')
                    ->where('is_active', true)
                    ->orderBy('categories.order');
            }
        ])
            ->active()
            ->ordered()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $applications,
            'message' => 'Applications retrieved successfully.'
        ]);
    }

    /**
     * Display the specified application.
     */
    public function show(Request $request,string $slug): JsonResponse
    {

        $lang = $request->query('lang', 'es');

        $application = Application::with([
            'categories' => function ($query) {
                $query
                    ->where('is_active', true)
                    ->orderBy('categories.order');
            }
        ])
            ->where('slug', $slug)
            ->orWhere('slug_en', $slug)
            ->orWhere('slug_fr', $slug)
            ->active()
            ->first();

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found.'
            ], 404);
        }

        // 👇 Construir SEO personalizado de la aplicación
        $seo = [
            'meta' => [
                'title' => $application->getMetaTitle($lang),
                'description' => $application->getMetaDescription($lang),
                'keywords' => $application->getMetaKeywords($lang),
                'robots' => 'index, follow',
            ],
            'og' => [
                'title' => $application->getOgTitle($lang),
                'description' => $application->getOgDescription($lang),
                'image' => $application->getOgImageUrl(),
                'type' => 'website',
            ],
            'twitter' => [
                'card' => 'summary_large_image',
                'title' => $application->getOgTitle($lang),
                'description' => $application->getOgDescription($lang),
                'image' => $application->getOgImageUrl(),
            ],
        ];

        $applicationArray = $application->toArray();
        $applicationArray['seo'] = $seo;

        return response()->json([
            'success' => true,
            'data' => $applicationArray,
            'message' => 'Application retrieved successfully.'
        ]);
    }

    /**
     * Get categories for a specific application.
     */
    public function categories(string $slug): JsonResponse
    {
        $application = Application::where('slug', $slug)
            ->orWhere('slug_en', $slug)
            ->orWhere('slug_fr', $slug)
            ->active()
            ->first(['id', 'name', 'slug']);

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found.'
            ], 404);
        }

        $categories = $application->categories()
            ->active()
            ->ordered()
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'application' => $application,
                'categories' => $categories
            ],
            'message' => 'Categories for application retrieved successfully.'
        ]);
    }
}