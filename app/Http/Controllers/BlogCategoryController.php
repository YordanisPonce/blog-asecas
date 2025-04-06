<?php

namespace App\Http\Controllers;

use App\Services\BlogCategoryService;
use App\Traits\ResponseTrait;

class BlogCategoryController extends Controller
{
    use ResponseTrait;

    public function __construct(private readonly BlogCategoryService $blogCategoryService)
    {
    }

    public function index()
    {
        return $this->sendResponse(data: $this->blogCategoryService->getAll());
    }

    public function show(string $slug)
    {
        return $this->sendResponse(data: $this->blogCategoryService->getBySlug($slug));
    }
}