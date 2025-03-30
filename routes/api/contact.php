<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;


Route::post('/', [ContactController::class, 'store']);