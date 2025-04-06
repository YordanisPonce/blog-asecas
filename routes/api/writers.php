<?php

use App\Http\Controllers\WriterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WriterController::class, 'index']);
Route::get('/{slug}', [WriterController::class, 'show']);
