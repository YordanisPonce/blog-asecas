<?php
// app/Filament/Pages/Inspiracion.php

namespace App\Filament\Pages;

use App\Models\InspirationPage as InspirationPageModel;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use App\Filament\Components\SeoFields; // ← IMPORTAR EL COMPONENTE SEO

class Inspiracion extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationLabel = 'Página Inspiración';
    protected static ?string $title = 'Contenido – Inspiración';
    protected static ?string $navigationGroup = 'Contenido web';
    protected static ?int $navigationSort = 60;

    protected static string $view = 'filament.pages.inspiracion';

    public InspirationPageModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = InspirationPageModel::first() ?? InspirationPageModel::create([]);

        // Cargar datos del modelo + SEO
        $this->form->fill([
            ...$this->record->toArray(),
            'seo' => $this->record->seo?->toArray() ?? [], // ← CARGAR SEO
        ]);
    }

    protected function getFormModel(): InspirationPageModel
    {
        return $this->record;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Contenido')
                    ->tabs([

                        // ===== TAB 1: TODO TU CONTENIDO EXISTENTE =====
                        Tabs\Tab::make('Contenido Principal')
                            ->icon('heroicon-o-document-text')
                            ->schema([

                                Section::make('Título')
                                    ->schema([
                                        Tabs::make('titles')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                TextInput::make('title_es')->label('Título (ES)')->required(),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                TextInput::make('title_en')->label('Title (EN)'),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                TextInput::make('title_fr')->label('Titre (FR)'),
                                            ]),
                                        ]),
                                    ]),

                                Section::make('Descripción (opcional)')
                                    ->schema([
                                        Tabs::make('descriptions')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                Textarea::make('description_es')->label('Descripción (ES)')->rows(4),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                Textarea::make('description_en')->label('Description (EN)')->rows(4),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                Textarea::make('description_fr')->label('Description (FR)')->rows(4),
                                            ]),
                                        ]),
                                    ]),

                                Section::make('Control de imágenes')
                                    ->schema([
                                        TextInput::make('default_limit')
                                            ->label('Límite sugerido para secciones pequeñas')
                                            ->helperText("Define cuántas imágenes se verán en secciones pequeñas (como la Home). Ej: 8 = se ven 8. En la página de Inspiración normalmente se ven todas. 0 = sin límite (se ven todas).")
                                            ->numeric()
                                            ->minValue(0)
                                            ->default(0),
                                    ]),
                            ]),

                        // ===== TAB 2: SEO (UNA SOLA LÍNEA) =====
                        SeoFields::make(), // ← ¡ASÍ DE SIMPLE!

                    ])
                    ->persistTabInQueryString(),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Guardar')
                ->submit('save')
                ->color('primary'),
        ];
    }

    

    public function save(): void
    {
        $this->form->validate();

        // 🔧 Procesar datos SEO antes de guardar
        $modelData = $this->data;
        $seoData = null;

        if (isset($modelData['seo'])) {
            $seoData = $modelData['seo'];

            // 🔧 Limpiar campos que son arrays
            $fieldsToClean = ['og_image', 'twitter_image'];
            foreach ($fieldsToClean as $field) {
                if (isset($seoData[$field]) && is_array($seoData[$field])) {
                    // Si es array vacío, poner null
                    if (empty($seoData[$field])) {
                        $seoData[$field] = null;
                    }
                    // Si es array con un elemento, tomar ese elemento
                    elseif (count($seoData[$field]) === 1) {
                        $seoData[$field] = $seoData[$field][0];
                    }
                }
            }

            unset($modelData['seo']); // Remover SEO de los datos del modelo
        }

        // Guardar contenido principal
        $this->record->fill($modelData);
        $this->record->save();

        // Guardar datos SEO (si existen)
        if ($seoData && is_array($seoData)) {
            try {
                $this->record->syncSeo($seoData);
                \Log::info('SEO saved successfully for InspirationPage');
            } catch (\Exception $e) {
                \Log::error('Error saving SEO: ' . $e->getMessage());
                \Log::error('SEO Data that caused error:', $seoData);

                Notification::make()
                    ->title('Error al guardar SEO')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
                return;
            }
        }

        Notification::make()
            ->title('Contenido de Inspiración actualizado.')
            ->success()
            ->send();
    }
}
