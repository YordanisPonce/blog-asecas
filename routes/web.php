<?php

use App\Http\Controllers\SuscriptionEmailController;
use Illuminate\Support\Facades\Route;

Route::permanentRedirect('/', '/admin');
Route::get('/verify-email', [SuscriptionEmailController::class, 'verify'])->name('verify-email');
Route::get('/un-verify-email', [SuscriptionEmailController::class, 'unVerify'])->name('unverify-email');

use Illuminate\Support\Facades\Route;

Route::get('/storage/files/{filename}', function ($filename) {
    $requested = rawurldecode($filename);
    $requestedLower = mb_strtolower($requested);

    /*
     |--------------------------------------------------------------------------
     | Parche SOLO para los PDFs de mortero hidrofugo capa fina / capa gruesa
     |--------------------------------------------------------------------------
     | No toca el resto de archivos.
     */

    $isMorteroHidrofugo = str_contains($requestedLower, 'hidrofugo')
        && str_contains($requestedLower, 'capa');

    if (! $isMorteroHidrofugo) {
        abort(404);
    }

    $type = null;

    if (str_contains($requestedLower, 'fina')) {
        $type = 'fina';
    }

    if (str_contains($requestedLower, 'gruesa')) {
        $type = 'gruesa';
    }

    if (! $type) {
        abort(404);
    }

    /*
     |--------------------------------------------------------------------------
     | Carpetas donde puede estar el archivo
     |--------------------------------------------------------------------------
     */

    $directories = [
        public_path('storage/files'),
        storage_path('app/public/files'),
    ];

    foreach ($directories as $directory) {
        if (! is_dir($directory)) {
            continue;
        }

        $files = glob($directory . '/*.pdf');

        foreach ($files as $filePath) {
            $realName = basename($filePath);
            $realNameLower = mb_strtolower($realName);

            $matches =
                str_contains($realNameLower, 'euro-money') &&
                str_contains($realNameLower, 'mortero') &&
                str_contains($realNameLower, 'monocapa') &&
                str_contains($realNameLower, 'hidrofugo') &&
                str_contains($realNameLower, 'capa') &&
                str_contains($realNameLower, $type);

            if ($matches && file_exists($filePath)) {
                return response()->file($filePath, [
                    'Content-Type' => 'application/pdf',
                ]);
            }
        }
    }

    abort(404);
})->where('filename', '.*');