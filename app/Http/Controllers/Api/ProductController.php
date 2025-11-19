<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Product::with([
            'category' => function ($query) {
                $query->select('id', 'name', 'slug');
            },
            'documents'
        ])
            ->active()
            ->ordered();

        // Filtrar por categoría si se proporciona
        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->get([
            'id',
            'name',
            'slug',
            'subtitle',
            'category_id',
            'image',
            'image_alt',
            'image_title',
            'composition_en',
            'composition_es',
            'composition_fr',
            'features_en',
            'features_es',
            'features_fr',
            'presentation',
            'pallet_info',
            'storage_info',
            'order'
        ]);

        return response()->json([
            'success' => true,
            'data' => $products,
            'message' => 'Products retrieved successfully.'
        ]);
    }

    /**
     * Display the specified product.
     */
    public function show(string $slug): JsonResponse
    {
        $product = Product::with([
            'category' => function ($query) {
                $query->select('id', 'name', 'slug');
            },
            'documents'
        ])->where('slug', $slug)
            ->where('slug_en', $slug)
            ->where('slug_fr', $slug)
            ->active()
            ->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product,
            'message' => 'Product retrieved successfully.'
        ]);
    }

    /**
     * Get documents for a specific product.
     */
    public function documents(string $slug): JsonResponse
    {
        $product = Product::where('slug', $slug)
            ->where('slug_en', $slug)
            ->where('slug_fr', $slug)
            ->active()
            ->first(['id', 'name', 'slug']);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ], 404);
        }

        $documents = $product->documents()
            ->ordered()
            ->get(['id', 'name', 'file_path', 'file_type', 'order']);

        return response()->json([
            'success' => true,
            'data' => [
                'product' => $product,
                'documents' => $documents
            ],
            'message' => 'Documents for product retrieved successfully.'
        ]);
    }

    /**
     * Get products by category slug.
     */
    public function byCategory(string $slug): JsonResponse
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

        $products = Product::with(['documents'])
            ->where('category_id', $category->id)
            ->active()
            ->ordered()
            ->get([
                'id',
                'name',
                'slug',
                'subtitle',
                'image',
                'image_alt',
                'image_title',
                'composition_en',
                'composition_es',
                'composition_fr',
                'features_en',
                'features_es',
                'features_fr',
                'presentation',
                'pallet_info',
                'storage_info',
                'order'
            ]);

        return response()->json([
            'success' => true,
            'data' => [
                'category' => $category,
                'products' => $products
            ],
            'message' => 'Products by category retrieved successfully.'
        ]);
    }

    /**
     * Search products by name, description, or features.
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

        $products = Product::with([
            'category' => function ($query) {
                $query->select('id', 'name', 'slug');
            }
        ])
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('subtitle', 'like', "%{$query}%")
                    ->orWhere('composition_en', 'like', "%{$query}%")
                    ->orWhere('composition_es', 'like', "%{$query}%")
                    ->orWhere('composition_fr', 'like', "%{$query}%")
                    ->orWhere('features_en', 'like', "%{$query}%")
                    ->orWhere('features_es', 'like', "%{$query}%")
                    ->orWhere('features_fr', 'like', "%{$query}%");
            })
            ->active()
            ->ordered()
            ->get([
                'id',
                'name',
                'slug',
                'subtitle',
                'category_id',
                'image',
                'composition_en',
                'composition_es',
                'composition_fr',
                'presentation',
                'order'
            ]);

        return response()->json([
            'success' => true,
            'data' => $products,
            'message' => 'Products search results.'
        ]);
    }
}