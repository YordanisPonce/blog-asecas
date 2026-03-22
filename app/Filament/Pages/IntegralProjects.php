<?php
// app/Filament/Pages/IntegralProjects.php

namespace App\Filament\Pages;

use App\Models\IntegralProjectsPage as PageModel;
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
use Filament\Forms\Components\Repeater;
use App\Filament\Components\SeoFields; // ← IMPORTAR EL COMPONENTE SEO

class IntegralProjects extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Contenido web';
    protected static ?int $navigationSort = 40;
    protected static ?string $navigationLabel = 'Servicio Integral de Proyectos';
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $title = 'Contenido – Servicio Integral de Proyectos';
    protected static string $view = 'filament.pages.integral-projects';

    public PageModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = PageModel::first() ?? PageModel::create(['id' => 1]);

        // Cargar datos del modelo + SEO
        $this->form->fill([
            ...$this->record->toArray(),
            'seo' => $this->record->seo?->toArray() ?? [], // ← CARGAR SEO
        ]);
    }

    protected function getFormModel(): PageModel
    {
        return $this->record;
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Contenido')
                ->tabs([

                    // ===== TAB 1: TODO TU CONTENIDO EXISTENTE =====
                    Tab::make('Contenido Principal')
                        ->icon('heroicon-o-document-text')
                        ->schema([

                            Section::make('Hero')->schema([
                                Grid::make(1)->schema([
                                    Tabs::make('hero_lang')->tabs([
                                        Tab::make('ES')->schema([
                                            Textarea::make('hero_title_es')->label('Título (ES)')->rows(2)
                                                ->helperText('Puede contener HTML.'),
                                            TextInput::make('hero_image_alt_es')->label('Imagen alt (ES)'),
                                        ]),
                                        Tab::make('EN')->schema([
                                            Textarea::make('hero_title_en')->label('Title (EN)')->rows(2),
                                            TextInput::make('hero_image_alt_en')->label('Image alt (EN)'),
                                        ]),
                                        Tab::make('FR')->schema([
                                            Textarea::make('hero_title_fr')->label('Titre (FR)')->rows(2),
                                            TextInput::make('hero_image_alt_fr')->label('Image alt (FR)'),
                                        ]),
                                    ]),

                                    FileUpload::make('hero_image_url')
                                        ->label('Imagen Hero')
                                        ->disk('public')
                                        ->directory('professionals')
                                        ->visibility('public')
                                        ->image()
                                        ->imageEditor()
                                        ->openable()
                                        ->downloadable(),
                                ]),
                            ]),

                            Section::make('Bloque – 6 tarjetas (3x2)')
                                ->description('Este bloque es el que se muestra en la web como grid 3x2. Se recomienda mantener 6 elementos.')
                                ->schema([
                                    Repeater::make('cards')
                                        ->label('Tarjetas')
                                        ->reorderable()
                                        ->defaultItems(6)
                                        ->minItems(0)
                                        ->collapsed()
                                        ->schema([
                                            Tabs::make('card_lang')->tabs([
                                                Tab::make('ES')->schema([
                                                    TextInput::make('title_es')->label('Título (ES)')->required(),
                                                    Textarea::make('text_es')->label('Texto (ES)')->rows(3)->required(),
                                                ]),
                                                Tab::make('EN')->schema([
                                                    TextInput::make('title_en')->label('Title (EN)')->required(),
                                                    Textarea::make('text_en')->label('Text (EN)')->rows(3)->required(),
                                                ]),
                                                Tab::make('FR')->schema([
                                                    TextInput::make('title_fr')->label('Titre (FR)')->required(),
                                                    Textarea::make('text_fr')->label('Texte (FR)')->rows(3)->required(),
                                                ]),
                                            ])->columnSpanFull(),
                                        ])
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Imagen Banner')->schema([
                                Tabs::make('banner_lang')->tabs([
                                    Tab::make('ES')->schema([
                                        TextInput::make('banner_image_title_es')->label('Imagen title (ES)'),
                                        TextInput::make('banner_image_alt_es')->label('Imagen alt (ES)'),
                                    ]),
                                    Tab::make('EN')->schema([
                                        TextInput::make('banner_image_title_en')->label('Image title (EN)'),
                                        TextInput::make('banner_image_alt_en')->label('Image alt (EN)'),
                                    ]),
                                    Tab::make('FR')->schema([
                                        TextInput::make('banner_image_title_fr')->label('Image title (FR)'),
                                        TextInput::make('banner_image_alt_fr')->label('Image alt (FR)'),
                                    ]),
                                ]),

                                FileUpload::make('banner_image_url')
                                    ->label('Imagen Banner')
                                    ->disk('public')
                                    ->directory('professionals')
                                    ->visibility('public')
                                    ->image()
                                    ->imageEditor()
                                    ->openable()
                                    ->downloadable(),
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
