<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Finish;
use Illuminate\Http\JsonResponse;

class FinishController extends Controller
{
    public function index(): JsonResponse
    {
        $finishes = Finish::with([
            'categories' => fn($q) => $q->active()->ordered()
        ])
            ->active()
            ->ordered()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $finishes,
            'message' => 'Finishes retrieved successfully.'
        ]);
    }


    public function show(string $slug): JsonResponse
    {
        $finish = Finish::with([
            'categories' => fn($q) => $q->active()->ordered()
        ])
            ->where('slug', $slug)
            ->orWhere('slug_en', $slug)
            ->orWhere('slug_fr', $slug)
            ->active()
            ->first();

        if (!$finish) {
            return response()->json([
                'success' => false,
                'message' => 'Finish not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $finish,
            'message' => 'Finish retrieved successfully.'
        ]);
    }
}
