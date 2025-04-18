<?php

use App\Http\Controllers\SuscriptionEmailController;
use Illuminate\Support\Facades\Route;

Route::permanentRedirect('/', '/admin');
Route::get('/verify-email', [SuscriptionEmailController::class, 'verify'])->name('verify-email');
Route::get('/un-verify-email', [SuscriptionEmailController::class, 'unVerify'])->name('unverify-email');
