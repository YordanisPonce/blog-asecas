<?php

use App\Http\Middleware\IsUserMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WriterController;
use App\Http\Controllers\BlogCategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(IsUserMiddleware::class)->group(function () {
    Route::group(
        [
            'prefix' => '/blog',
        ],
        base_path('routes/api/blog.php')
    );
    Route::group(
        [
            'prefix' => '/carousel',
        ],
        base_path('routes/api/carousel.php')
    );

    Route::group(
        [
            'prefix' => '/events',
        ],
        base_path('routes/api/events.php')
    );
    Route::group(
        [
            'prefix' => '/contact',
        ],
        base_path('routes/api/contact.php')
    );

    Route::group(
        [
            'prefix' => '/writers',
        ],
        base_path('routes/api/writers.php')
    );


    Route::group(
        [
            'prefix' => '/suscriptions',
        ],
        base_path('routes/api/suscriptions.php')
    );

    Route::group(
        [
            'prefix' => '/blog-categories',
        ],
        base_path('routes/api/blog-categories.php')
    );

});



