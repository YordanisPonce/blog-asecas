<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inspiration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InspirationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // opcional: limitar cantidad para tu grid
        $limit = (int) $request->query('limit', 0);

        $q = Inspiration::query()->active(); // ya viene ordenado por global scope

        if ($limit > 0) {
            $q->limit($limit);
        }

        $items = $q->get();

        return response()->json([
            'success' => true,
            'data' => $items,
            'message' => 'Inspirations retrieved successfully.',
        ]);
    }
}
