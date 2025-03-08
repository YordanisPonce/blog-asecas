<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(
    [
        'prefix' => '/blog'
    ],
    base_path('routes/api/blog.php')
);
