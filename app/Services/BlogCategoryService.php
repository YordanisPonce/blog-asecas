<?php

namespace App\Services;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogCategoryService extends Service
{
    public function __construct()
    {
        $this->record = new BlogCategory();
    }

    public function getAll(): array
    {
        return BlogCategory::orderBy('name')->get()->toArray();
    }

    public function getBySlug(string $slug): BlogCategory
    {
        $category = BlogCategory::where('slug', $slug)->first();
        
        if (!$category) {
            throw new ModelNotFoundException("Blog category not found with slug: {$slug}");
        }
        
        return $category;
    }
} 