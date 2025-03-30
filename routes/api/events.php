<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;


Route::get('/', [EventController::class, 'index']);
Route::get('/{slug}', [EventController::class, 'show']);