<?php

namespace App\Http\Controllers;

use App\Services\WriterService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class WriterController extends Controller
{

    use ResponseTrait;
    public function __construct(
        private readonly WriterService $writerService
    ) {
    }

    public function index(): JsonResponse
    {
        return $this->sendResponse(data: $this->writerService->getAll());
    }

    public function show(string $slug): JsonResponse
    {
        return $this->sendResponse(data: $this->writerService->getBySlug($slug));
    }
}