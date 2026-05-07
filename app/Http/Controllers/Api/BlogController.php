<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('active', 1)->orderByDesc('id')->get();
        return response()->json([
            'success' => true,
            'data' => $blogs,
        ]);
    }

    public function show(Request $request, string $slug)
    {
        $lang = $request->query('lang', 'es');

        $blog = Blog::where(function ($query) use ($slug) {
            $query->where('slug', $slug)      // español
                ->orWhere('slug_en', $slug) // inglés
                ->orWhere('slug_fr', $slug); // francés
        })
            ->where('active', 1)
            ->firstOrFail();

        $blogArray['photo_url'] = $blog->photo_url;

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
        $blogArray['photo_url'] = $blog->photo_url;

        return response()->json([
            'success' => true,
            'data' => $blogArray,
        ]);
    }
}
