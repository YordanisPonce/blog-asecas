<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(): JsonResponse
    {
        $categories = Category::with([
            'applications' => function ($query) {
                $query->select('applications.id', 'applications.name', 'applications.slug', 'applications.icon')
                    ->where('is_active', true)
                    ->orderBy('applications.order');
            }
        ])
            ->active()
            ->ordered()
            ->get(['id', 'name', 'slug', 'image', 'image_alt', 'image_title', 'short_description_en', 'short_description_es', 'short_description_fr', 'categories.order']);

        return response()->json([
            'success' => true,
            'data' => $categories,
            'message' => 'Categories retrieved successfully.'
        ]);
    }

    /**
     * Display the specified category.
     */
    public function show(string $slug): JsonResponse
    {
        $category = Category::with([
            'products' => function ($query) {
                $query->select('products.id', 'products.name', 'products.slug', 'products.subtitle', 'products.image', 'products.category_id')
                    ->active()
                    ->ordered();
            },
            'applications' => function ($query) {
                $query->select('applications.id', 'applications.name', 'applications.slug', 'applications.icon')
                    ->active()
                    ->ordered();
            }
        ])
            ->where('slug', $slug)
            ->where('slug_en', $slug)
            ->where('slug_fr', $slug)
            ->active()
            ->first(['id', 'name', 'slug', 'image', 'image_alt', 'image_title', 'short_description_en', 'short_description_es', 'short_description_fr', 'description_en', 'description_es', 'description_fr', 'order']);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category,
            'message' => 'Category retrieved successfully.'
        ]);
    }

    /**
     * Get products for a specific category.
     */
    public function products(string $slug): JsonResponse
    {
        $category = Category::where('slug', $slug)
            ->where('slug_en', $slug)
            ->where('slug_fr', $slug)
            ->active()
            ->first(['id', 'name', 'slug']);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.'
            ], 404);
        }

        $products = $category->products()
            ->active()
            ->ordered()
            ->get(['id', 'name', 'slug', 'subtitle', 'image', 'image_alt', 'image_title', 'presentation', 'order']);

        return response()->json([
            'success' => true,
            'data' => [
                'category' => $category,
                'products' => $products
            ],
            'message' => 'Products for category retrieved successfully.'
        ]);
    }

    /**
     * Get applications for a specific category.
     */
    public function applications(string $slug): JsonResponse
    {
        $category = Category::where('slug', $slug)
            ->where('slug_en', $slug)
            ->where('slug_fr', $slug)
            ->active()
            ->first(['id', 'name', 'slug']);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.'
            ], 404);
        }

        $applications = $category->applications()
            ->active()
            ->ordered()
            ->get(['id', 'name', 'slug', 'icon', 'image', 'image_alt', 'image_title', 'short_description_en', 'short_description_es', 'short_description_fr', 'order']);

        return response()->json([
            'success' => true,
            'data' => [
                'category' => $category,
                'applications' => $applications
            ],
            'message' => 'Applications for category retrieved successfully.'
        ]);
    }

    /**
     * Search categories by name.
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Search query is required.'
            ], 400);
        }

        $categories = Category::where('name', 'like', "%{$query}%")
            ->orWhere('short_description_en', 'like', "%{$query}%")
            ->orWhere('short_description_es', 'like', "%{$query}%")
            ->orWhere('short_description_fr', 'like', "%{$query}%")
            ->active()
            ->ordered()
            ->get(['id', 'name', 'slug', 'image', 'short_description_en', 'short_description_es', 'short_description_fr', 'order']);

        return response()->json([
            'success' => true,
            'data' => $categories,
            'message' => 'Categories search results.'
        ]);
    }
}