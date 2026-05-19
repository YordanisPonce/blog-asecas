<?php

use App\Http\Controllers\SuscriptionEmailController;
use Illuminate\Support\Facades\Route;

Route::permanentRedirect('/', '/admin');
Route::get('/verify-email', [SuscriptionEmailController::class, 'verify'])->name('verify-email');
Route::get('/un-verify-email', [SuscriptionEmailController::class, 'unVerify'])->name('unverify-email');

Route::get('/storage/files/{filename}', function ($filename) {
    $decoded = rawurldecode($filename);

    // Normaliza espacios dobles, espacios raros y apóstrofes
    $normalized = preg_replace('/\s+/', ' ', trim($decoded));

    $map = [
        "EURO MONEY F' mortero monocapa hidrofugo capa gruesa.pdf" => "EURO-MONEY-F-mortero-monocapa-hidrofugo-capa-gruesa.pdf",
        "EURO MONEY F' mortero monocapa hidrofugo capa fina.pdf"   => "EURO-MONEY-F-mortero-monocapa-hidrofugo-capa-fina.pdf",
    ];

    // Si no es uno de esos 2 archivos, no toca nada
    if (!isset($map[$normalized])) {
        abort(404);
    }

    $realFilename = $map[$normalized];

    $possiblePaths = [
        public_path('storage/files/' . $realFilename),
        storage_path('app/public/files/' . $realFilename),
    ];

    foreach ($possiblePaths as $path) {
        if (file_exists($path)) {
            return response()->file($path, [
                'Content-Type' => 'application/pdf',
            ]);
        }
    }

    abort(404);
})->where('filename', '.*');