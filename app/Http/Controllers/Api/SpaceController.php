<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Space;

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

    public function show(string $slug)
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
            'data' => $space,
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
