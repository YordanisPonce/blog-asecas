<?php
// app/Http/Controllers/Api/BlogPageController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPage;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    public function show(Request $request)
    {
        $lang = $request->query('lang', 'es');
        abort_unless(in_array($lang, ['es', 'en', 'fr']), 422, 'Invalid lang');

        $page = BlogPage::with('seo')->first() ?? BlogPage::create([]);

        $blogs = Blog::where('active', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'response' => [
                'blogs' => $blogs,
                'seo' => $page->getSeoForApi($lang),
            ],
        ]);
    }
}
