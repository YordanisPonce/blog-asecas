<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('active', 1)->orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $blogs,
        ]);
    }

    public function show(Request $request, string $slug)
    {
        $lang = $request->query('lang', 'es');

        $blog = Blog::where('slug', $slug)->where('active', 1)->firstOrFail();

        // Construir SEO personalizado
        $seo = [
            'meta' => [
                'title' => $blog->getMetaTitle($lang),
                'description' => $blog->getMetaDescription($lang),
                'keywords' => $blog->getMetaKeywords($lang),
                'robots' => 'index, follow',
                'author' => optional($blog->writer)->name ?? 'Grupo Estucalia',
                'publisher' => 'Grupo Estucalia',
                'canonical' => $request->url(),
            ],
            'og' => [
                'title' => $blog->getOgTitle($lang),
                'description' => $blog->getOgDescription($lang),
                'image' => $blog->getOgImageUrl(),
                'type' => 'article',
            ],
            'twitter' => [
                'card' => 'summary_large_image',
                'title' => $blog->getOgTitle($lang),
                'description' => $blog->getOgDescription($lang),
                'image' => $blog->getOgImageUrl(),
            ],
        ];

        $blogArray = $blog->toArray();
        $blogArray['seo'] = $seo;

        return response()->json([
            'success' => true,
            'data' => $blogArray,
        ]);
    }
}
