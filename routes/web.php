<?php

use App\Http\Controllers\SuscriptionEmailController;
use Illuminate\Support\Facades\Route;

Route::permanentRedirect('/', '/admin');
Route::get('/verify-email', [SuscriptionEmailController::class, 'verify'])->name('verify-email');
Route::get('/un-verify-email', [SuscriptionEmailController::class, 'unVerify'])->name('unverify-email');

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/files/{filename}', function ($filename) {
    // Decodifica URL y limpia espacios repetidos
    $decoded = urldecode($filename);
    $decoded = preg_replace('/\s+/', ' ', trim($decoded));

    /*
     * Parche SOLO para estos 2 archivos antiguos.
     * Todo lo demás queda igual.
     */
    $map = [
        "EURO MONEY F' mortero monocapa hidrofugo capa gruesa.pdf" => "EURO-MONEY-F-mortero-monocapa-hidrofugo-capa-gruesa.pdf",
        "EURO MONEY F' mortero monocapa hidrofugo capa fina.pdf"   => "EURO-MONEY-F-mortero-monocapa-hidrofugo-capa-fina.pdf",
    ];

    $finalFilename = $map[$decoded] ?? $decoded;

    /*
     * Busca el archivo en posibles ubicaciones.
     * Deja las 3 para no romper según dónde esté guardado.
     */
    $possiblePaths = [
        public_path('files/' . $finalFilename),
        public_path('storage/files/' . $finalFilename),
        storage_path('app/public/files/' . $finalFilename),
    ];

    foreach ($possiblePaths as $path) {
        if (file_exists($path)) {
            return response()->file($path);
        }
    }

    abort(404);
})->where('filename', '.*');