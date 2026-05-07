<?php

namespace App\Providers;

use Filament\Forms\Components\FileUpload;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configuración por defecto para TODOS los FileUpload de Filament.
        // El cliente quiere que en cada subida se pueda previsualizar la
        // imagen, descargarla y abrirla en una pestaña nueva. Sin esto, los
        // FileUpload aparecen como "Loading…" en algunos navegadores (Edge).
        // Cualquier FileUpload puede sobreescribir estos defaults llamando
        // ->openable(false), ->downloadable(false), etc.
        FileUpload::configureUsing(function (FileUpload $component) {
            $component
                ->openable()
                ->downloadable()
                ->previewable(true)
                ->imagePreviewHeight('150');
        });
    }
}
