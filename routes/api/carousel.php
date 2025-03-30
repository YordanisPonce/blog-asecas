<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CarouselController;
use Illuminate\Support\Facades\Route;


Route::get('/', [CarouselController::class, 'index']);
Route::get('/{slug}', [CarouselController::class, 'show']);