<?php
namespace App\Traits;

trait ResponseTrait
{
    public function sendResponse(
        $success = true,
        $data = null,
        $message = null,
        $params = []
    ) {
        return response()->json([
            'success' => $success ?? false,
            'data' => $data ?? null,
            'message' => $message ?? null,
            ...$params
        ]);
    }
}