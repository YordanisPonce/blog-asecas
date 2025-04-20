<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;


Route::get('/', [EventController::class, 'index']);
Route::post('/enroll/{event}', [EventController::class, 'enroll']);
Route::get('/{slug}', [EventController::class, 'show']);