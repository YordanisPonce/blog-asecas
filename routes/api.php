<?php

use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FinishController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\InspirationController;
use App\Http\Controllers\Api\InspirationPageController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SpaceController;
use App\Http\Middleware\IsUserMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WriterController;
use App\Http\Controllers\BlogCategoryController;
use App\Models\Category;
use App\Models\Home;

use App\Models\Empresa;
use App\Models\ContactPage;
use App\Models\LegalPage;
use App\Models\PrivacyPage;
use App\Models\CookiesPage;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(IsUserMiddleware::class)->group(function () {
    Route::group(
        [
            'prefix' => '/blog',
        ],
        base_path('routes/api/blog.php')
    );
    Route::group(
        [
            'prefix' => '/carousel',
        ],
        base_path('routes/api/carousel.php')
    );

    Route::group(
        [
            'prefix' => '/events',
        ],
        base_path('routes/api/events.php')
    );
    Route::group(
        [
            'prefix' => '/contact',
        ],
        base_path('routes/api/contact.php')
    );

    Route::group(
        [
            'prefix' => '/writers',
        ],
        base_path('routes/api/writers.php')
    );


    Route::group(
        [
            'prefix' => '/suscriptions',
        ],
        base_path('routes/api/suscriptions.php')
    );

    Route::group(
        [
            'prefix' => '/blog-categories',
        ],
        base_path('routes/api/blog-categories.php')
    );

});

// HOME
Route::get('/home', fn() => response()->json(Home::firstOrCreate([])));
Route::put('/home', function (Request $request) {
    $model = Home::firstOrCreate([]);
    $model->fill($request->all())->save();
    return response()->json($model);
});

// EMPRESA
Route::get('/empresa', fn() => response()->json(Empresa::firstOrCreate([])));
Route::put('/empresa', function (Request $request) {
    $model = Empresa::firstOrCreate([]);
    $model->fill($request->all())->save();
    return response()->json($model);
});

// CONTACTO
Route::get('/contacto', fn() => response()->json(ContactPage::firstOrCreate([])));
Route::put('/contacto', function (Request $request) {
    $model = ContactPage::firstOrCreate([]);
    $model->fill($request->all())->save();
    return response()->json($model);
});

// LEGAL NOTICE / AVISO LEGAL
Route::get('/legal', fn() => response()->json(LegalPage::firstOrCreate([])));
Route::put('/legal', function (Request $request) {
    $model = LegalPage::firstOrCreate([]);
    $model->fill($request->all())->save();
    return response()->json($model);
});

// PRIVACIDAD
Route::get('/privacidad', fn() => response()->json(PrivacyPage::firstOrCreate([])));
Route::put('/privacidad', function (Request $request) {
    $model = PrivacyPage::firstOrCreate([]);
    $model->fill($request->all())->save();
    return response()->json($model);
});

// COOKIES
Route::get('/cookies', fn() => response()->json(CookiesPage::firstOrCreate([])));
Route::put('/cookies', function (Request $request) {
    $model = CookiesPage::firstOrCreate([]);
    $model->fill($request->all())->save();
    return response()->json($model);
});

/*
|--------------------------------------------------------------------------
| API: Sub-secciones útiles de Home
|--------------------------------------------------------------------------
| Endpoints rápidos para consumir solo partes concretas.
*/

Route::get('/home/applications', fn() => response()->json(
    optional(Home::first())->applications_items ?? []
));

Route::get('/home/finishes', fn() => response()->json(
    optional(Home::first())->finishes_tabs ?? []
));

Route::get('/home/inspiration', fn() => response()->json([
    'text' => [
        'es' => optional(Home::first())->inspiration_text_es,
        'en' => optional(Home::first())->inspiration_text_en,
        'fr' => optional(Home::first())->inspiration_text_fr,
    ],
    'images' => [
        'es' => optional(Home::first())->inspiration_images_es ?? [],
        'en' => optional(Home::first())->inspiration_images_en ?? [],
        'fr' => optional(Home::first())->inspiration_images_fr ?? [],
    ],
]));


Route::get('/categories', fn() => response()->json(Category::all()));

// Public routes
Route::prefix('v1')->group(function () {

    Route::get('/home', [HomeController::class, 'show']);


    // Categories endpoints
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{slug}', [CategoryController::class, 'show']);
    Route::get('/categories/{slug}/products', [CategoryController::class, 'products']);
    Route::get('/categories/{slug}/applications', [CategoryController::class, 'applications']);

    // Products endpoints
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{slug}', [ProductController::class, 'show']);
    Route::get('/products/{slug}/documents', [ProductController::class, 'documents']);
    Route::get('/products/category/{categorySlug}', [ProductController::class, 'byCategory']);

    // Applications endpoints
    Route::get('/applications', [ApplicationController::class, 'index']);
    Route::get('/applications/{slug}', [ApplicationController::class, 'show']);
    Route::get('/applications/{slug}/categories', [ApplicationController::class, 'categories']);

    Route::get('/finishes', [FinishController::class, 'index']);
    Route::get('/finishes/{slug}', [FinishController::class, 'show']);

    // Search endpoints
    Route::get('/search', [ProductController::class, 'search']);
    Route::get('/search/categories', [CategoryController::class, 'search']);

    Route::get('/inspiration-page', [InspirationPageController::class, 'show']);
    Route::get('/inspirations', [InspirationController::class, 'index']);

    Route::get('/spaces', [SpaceController::class, 'index']);
    Route::get('/spaces/{slug}', [SpaceController::class, 'show']);
    Route::get('/spaces/{slug}/applications', [SpaceController::class, 'applications']);

    Route::get('/constructores-arquitectos', [\App\Http\Controllers\Api\BuildersArchitectsPageController::class, 'show']);
    
    Route::get('/aplicadores', [\App\Http\Controllers\Api\ApplicatorsPageController::class, 'show']);
    
    Route::get('/servicio-integral-proyectos', [\App\Http\Controllers\Api\IntegralProjectsPageController::class, 'show']);

    Route::get('/certificaciones-documentacion', [\App\Http\Controllers\Api\CertificationsDocumentationPageController::class, 'show']);
    Route::get('/certificaciones-documentacion/download/{key}', [\App\Http\Controllers\Api\CertificationsDocumentationPageController::class, 'download']);
});

