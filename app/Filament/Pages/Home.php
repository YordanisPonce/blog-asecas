<?php
// app/Filament/Pages/Home.php

namespace App\Filament\Pages;

use App\Models\Home as HomeModel;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use App\Filament\Components\SeoFields; // ← IMPORTAR EL COMPONENTE SEO

class Home extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Contenido web';
    protected static ?int $navigationSort = 100;
    protected static ?string $navigationLabel = 'Home y Ayuda';
    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $title = 'Sección Home y Ayuda';
    protected static string $view = 'filament.pages.home';

    public HomeModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = HomeModel::first() ?? HomeModel::create([]);

        // Cargar datos del modelo + SEO
        $this->form->fill([
            ...$this->record->toArray(),
            'seo' => $this->record->seo?->toArray() ?? [], // ← CARGAR SEO
        ]);
    }

    protected function getFormModel(): HomeModel
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
                        Tab::make('Contenido Principal')
                            ->icon('heroicon-o-document-text')
                            ->schema([

                                //---------------- HERO ----------------
                                Section::make('Hero')
                                    ->schema([
                                        Grid::make(1)->schema([
                                            Tabs::make('hero_lang')
                                                ->tabs([
                                                    Tab::make('ES')->schema([
                                                        TextInput::make('first_title_es')->label('Título (ES)')->required(),
                                                        TextInput::make('first_image_title_es')->label('Imagen title (ES)'),
                                                        TextInput::make('first_image_alt_es')->label('Imagen alt (ES)'),
                                                    ]),
                                                    Tab::make('EN')->schema([
                                                        TextInput::make('first_title_en')->label('Title (EN)'),
                                                        TextInput::make('first_image_title_en')->label('Image title (EN)'),
                                                        TextInput::make('first_image_alt_en')->label('Image alt (EN)'),
                                                    ]),
                                                    Tab::make('FR')->schema([
                                                        TextInput::make('first_title_fr')->label('Titre (FR)'),
                                                        TextInput::make('first_image_title_fr')->label('Image title (FR)'),
                                                        TextInput::make('first_image_alt_fr')->label('Image alt (FR)'),
                                                    ]),
                                                ])
                                                ->columnSpan(1),

                                            FileUpload::make('first_image_url')
                                                ->label('Imagen Hero')
                                                ->disk('public')
                                                ->directory('home')
                                                ->visibility('public')
                                                ->image()
                                                ->imageEditor()
                                                ->openable()
                                                ->downloadable()
                                                ->columnSpan(1),
                                        ]),
                                    ]),

                                //---------------- BLOQUE 2 ----------------
                                Section::make('Bloque 2')
                                    ->schema([
                                        Tabs::make('second_lang')
                                            ->tabs([
                                                Tab::make('ES')->schema([
                                                    TextInput::make('second_title_es')->label('Línea pequeña (ES)'),
                                                    Textarea::make('second_description_es')->rows(2)->label('Línea grande (ES)'),
                                                ]),
                                                Tab::make('EN')->schema([
                                                    TextInput::make('second_title_en')->label('Small line (EN)'),
                                                    Textarea::make('second_description_en')->rows(2)->label('Big line (EN)'),
                                                ]),
                                                Tab::make('FR')->schema([
                                                    TextInput::make('second_title_fr')->label('Ligne petite (FR)'),
                                                    Textarea::make('second_description_fr')->rows(2)->label('Ligne grande (FR)'),
                                                ]),
                                            ]),
                                    ]),

                                // ---------------- CTA HELP ----------------
                                Section::make('CTA – Help')
                                    ->schema([
                                        Grid::make(1)->schema([
                                            Tabs::make('cta_help_lang')
                                                ->tabs([
                                                    Tab::make('ES')->schema([
                                                        TextInput::make('cta_help_title_es')->label('Título (ES)'),
                                                        Textarea::make('cta_help_text_es')->label('Texto (ES)')->rows(4),
                                                        TextInput::make('cta_help_button_es')->label('Texto botón (ES)'),
                                                        TextInput::make('cta_help_image_title_es')->label('BG title (ES)'),
                                                        TextInput::make('cta_help_image_alt_es')->label('BG alt (ES)'),
                                                    ]),
                                                    Tab::make('EN')->schema([
                                                        TextInput::make('cta_help_title_en')->label('Title (EN)'),
                                                        Textarea::make('cta_help_text_en')->label('Text (EN)')->rows(4),
                                                        TextInput::make('cta_help_button_en')->label('Button (EN)'),
                                                        TextInput::make('cta_help_image_title_en')->label('BG title (EN)'),
                                                        TextInput::make('cta_help_image_alt_en')->label('BG alt (EN)'),
                                                    ]),
                                                    Tab::make('FR')->schema([
                                                        TextInput::make('cta_help_title_fr')->label('Titre (FR)'),
                                                        Textarea::make('cta_help_text_fr')->label('Texte (FR)')->rows(4),
                                                        TextInput::make('cta_help_button_fr')->label('Bouton (FR)'),
                                                        TextInput::make('cta_help_image_title_fr')->label('BG title (FR)'),
                                                        TextInput::make('cta_help_image_alt_fr')->label('BG alt (FR)'),
                                                    ]),
                                                ])
                                                ->columnSpan(1),
                                            FileUpload::make('cta_help_image_url')
                                                ->label('Imagen de fondo CTA')
                                                ->disk('public')
                                                ->directory('home')
                                                ->visibility('public')
                                                ->image()
                                                ->imageEditor()
                                                ->openable()
                                                ->downloadable()
                                                ->columnSpan(1),
                                        ]),

                                        Grid::make(2)->schema([
                                            TextInput::make('cta_help_url')
                                                ->label('URL del botón')
                                                ->placeholder('/contacto')
                                                ->helperText('Puede ser una ruta interna (ej: /contacto) o una URL completa (https://...)')
                                                ->rule('regex:/^(\/[^\s]*)$|^(https?:\/\/[^\s]+)$/i')
                                                ->columnSpan(1),
                                        ]),
                                    ]),
                            ]),

                        // ===== TAB 2: SEO (REUTILIZABLE) =====
                        SeoFields::make(), // ← ¡UNA SOLA LÍNEA!

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
