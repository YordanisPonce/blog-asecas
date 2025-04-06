<?php

use App\Http\Controllers\BlogCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogCategoryController::class, 'index']);
Route::get('/{slug}', [BlogCategoryController::class, 'show']);