<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\SuscriptionEmailController;
use Illuminate\Support\Facades\Route;


Route::post('/', [SuscriptionEmailController::class, 'store']);