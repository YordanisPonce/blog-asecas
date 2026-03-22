<?php
// app/Filament/Pages/Cookies.php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\CookiesPage as CookiesModel;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use App\Filament\Components\SeoFields; // ← IMPORTAR EL COMPONENTE SEO

class Cookies extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationLabel = 'Política de Cookies';
    protected static ?string $title = 'Contenido – Política de Cookies';
    protected static string $view = 'filament.pages.cookies';

    protected static ?string $navigationGroup = 'Legal';
    protected static ?int $navigationSort = 30;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public CookiesModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = CookiesModel::first() ?? CookiesModel::create([]);

        // Cargar datos del modelo + SEO
        $this->form->fill([
            ...$this->record->toArray(),
            'seo' => $this->record->seo?->toArray() ?? [], // ← CARGAR SEO
        ]);
    }

    protected function getFormModel(): CookiesModel
    {
        return $this->record;
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Contenido')
                ->tabs([

                    // ===== TAB 1: TODO TU CONTENIDO EXISTENTE =====
                    Tabs\Tab::make('Contenido Principal')
                        ->icon('heroicon-o-document-text')
                        ->schema([

                            Section::make('Título de la página')->schema([
                                Tabs::make('page_titles')->tabs([
                                    Tabs\Tab::make('ES')->schema([
                                        TextInput::make('page_title_es')->label('Título (ES)')
                                            ->placeholder('Política de Cookies'),
                                    ]),
                                    Tabs\Tab::make('EN')->schema([
                                        TextInput::make('page_title_en')->label('Title (EN)')
                                            ->placeholder('Cookies Policy'),
                                    ]),
                                    Tabs\Tab::make('FR')->schema([
                                        TextInput::make('page_title_fr')->label('Titre (FR)')
                                            ->placeholder('Politique de cookies'),
                                    ]),
                                ]),
                                Grid::make(3)->schema([
                                    DatePicker::make('last_updated_at')->label('Última actualización')->native(false),
                                ]),
                            ])->columns(1),

                            Section::make('Introducción')->schema([
                                Tabs::make('intro')->tabs([
                                    Tabs\Tab::make('ES')->schema([Textarea::make('intro_es')->rows(7)]),
                                    Tabs\Tab::make('EN')->schema([Textarea::make('intro_en')->rows(7)]),
                                    Tabs\Tab::make('FR')->schema([Textarea::make('intro_fr')->rows(7)]),
                                ]),
                            ]),

                            Section::make('Información recopilada / funcionamiento')->schema([
                                Tabs::make('collected')->tabs([
                                    Tabs\Tab::make('ES')->schema([Textarea::make('collected_info_es')->rows(7)]),
                                    Tabs\Tab::make('EN')->schema([Textarea::make('collected_info_en')->rows(7)]),
                                    Tabs\Tab::make('FR')->schema([Textarea::make('collected_info_fr')->rows(7)]),
                                ]),
                            ]),

                            Section::make('Nota sobre datos personales / identificación')->schema([
                                Tabs::make('personal_note')->tabs([
                                    Tabs\Tab::make('ES')->schema([Textarea::make('personal_data_note_es')->rows(6)]),
                                    Tabs\Tab::make('EN')->schema([Textarea::make('personal_data_note_en')->rows(6)]),
                                    Tabs\Tab::make('FR')->schema([Textarea::make('personal_data_note_fr')->rows(6)]),
                                ]),
                            ]),

                            Section::make('Consentimiento')->schema([
                                Tabs::make('consent')->tabs([
                                    Tabs\Tab::make('ES')->schema([Textarea::make('consent_es')->rows(6)]),
                                    Tabs\Tab::make('EN')->schema([Textarea::make('consent_en')->rows(6)]),
                                    Tabs\Tab::make('FR')->schema([Textarea::make('consent_fr')->rows(6)]),
                                ]),
                            ]),

                            Section::make('Deshabilitar, rechazar y borrar cookies')->schema([
                                Tabs::make('disable')->tabs([
                                    Tabs\Tab::make('ES')->schema([Textarea::make('disable_reject_delete_es')->rows(8)]),
                                    Tabs\Tab::make('EN')->schema([Textarea::make('disable_reject_delete_en')->rows(8)]),
                                    Tabs\Tab::make('FR')->schema([Textarea::make('disable_reject_delete_fr')->rows(8)]),
                                ]),
                            ]),
                        ]),

                    // ===== TAB 2: SEO (UNA SOLA LÍNEA) =====
                    SeoFields::make(), // ← ¡ASÍ DE SIMPLE!

                ])
                ->persistTabInQueryString(),
        ])->statePath('data');
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
        $data = $this->form->getState();

        // Guardar contenido principal
        $this->record->fill($data);
        $this->record->save();

        // Guardar datos SEO (si existen)
        if (isset($data['seo'])) {
            $this->record->syncSeo($data['seo']);
        }

        Notification::make()
            ->title('Cambios guardados satisfactoriamente')
            ->success()
            ->send();
    }
}
