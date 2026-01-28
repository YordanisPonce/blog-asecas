<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inspiration;
use App\Models\InspirationPage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InspirationPageController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $page = InspirationPage::firstOrCreate([]);

        $limit = (int) $request->query('limit', 0);
        if ($limit <= 0) {
            $limit = (int) ($page->default_limit ?? 0);
        }

        $q = Inspiration::query()->active();

        if ($limit > 0) {
            $q->limit($limit);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'page' => $page,
                'items' => $q->get(),
            ],
            'message' => 'Inspiration page retrieved successfully.',
        ]);
    }
}
