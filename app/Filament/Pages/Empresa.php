<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Empresa as EmpresaModel;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

// Components
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs\Tab;


class Empresa extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Sitio';
    protected static ?int $navigationSort = 20;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $title = 'Contenido – Empresa';
    protected static string $view = 'filament.pages.empresa';

    /** Singleton record */
    public EmpresaModel $record;

    /** Form state */
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = EmpresaModel::firstOrCreate(['id' => 1]);
        $this->form->fill($this->record->toArray());
    }

    /** Hace que el form use el registro singleton */
    protected function getFormModel(): EmpresaModel
    {
        return $this->record;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                /* ===================== HERO ===================== */
                Section::make('Hero')
                    ->description('Video/imagen de cabecera y titular.')
                    ->schema([
                        Tabs::make('hero_tabs')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                TextInput::make('hero_title_es')->label('Título (ES)'),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                TextInput::make('hero_title_en')->label('Title (EN)'),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                TextInput::make('hero_title_fr')->label('Titre (FR)'),
                            ]),
                        ]),
                        Grid::make()->columns(4)->schema([
                            TextInput::make('hero_video_url')->label('Video URL')->url()->nullable(),
                            FileUpload::make('hero_image')
                                ->label('Imagen (Hero)')
                                ->image()
                                ->disk('public')
                                ->directory('empresa/hero')
                                ->visibility('public')
                                ->preserveFilenames()
                                ->openable()
                                ->downloadable()
                                ->nullable(),

                            TextInput::make('hero_image_title')->label('Imagen title')->nullable(),
                            TextInput::make('hero_image_alt')->label('Imagen alt')->nullable(),
                        ])
                    ])->columns(1),

                /* ===================== ABOUT ===================== */
                Section::make('About – Somos Grupo Estucalia')
                    ->schema([
                        Tabs::make('about_tabs')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                TextInput::make('about_title_es')->label('Título (ES)'),
                                Textarea::make('about_text_es')->label('Texto (ES)')->rows(3),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                TextInput::make('about_title_en')->label('Title (EN)'),
                                Textarea::make('about_text_en')->label('Text (EN)')->rows(3),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                TextInput::make('about_title_fr')->label('Titre (FR)'),
                                Textarea::make('about_text_fr')->label('Texte (FR)')->rows(3),
                            ]),
                        ]),
                        Grid::make(3)->schema([
                            FileUpload::make('about_illustration')
                                ->label('Ilustración (About)')
                                ->image()
                                ->disk('public')
                                ->directory('empresa/about')
                                ->visibility('public')
                                ->preserveFilenames()
                                ->openable()
                                ->downloadable()
                                ->nullable(),

                            TextInput::make('about_illustration_title')->label('Ilustración title')->nullable(),
                            TextInput::make('about_illustration_alt')->label('Ilustración alt')->nullable(),
                        ]),
                    ])->columns(1),

                /* ===================== MISIÓN ===================== */
                Section::make('Misión')
                    ->schema([
                        Tabs::make('mission_tabs')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                TextInput::make('mission_title_es')->label('Título (ES)'),
                                Textarea::make('mission_text_es')->label('Texto (ES)')->rows(3),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                TextInput::make('mission_title_en')->label('Title (EN)'),
                                Textarea::make('mission_text_en')->label('Text (EN)')->rows(3),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                TextInput::make('mission_title_fr')->label('Titre (FR)'),
                                Textarea::make('mission_text_fr')->label('Texte (FR)')->rows(3),
                            ]),
                        ]),
                    ])->columns(1),

                /* ===================== PRODUCCIÓN ===================== */
                Section::make('Producción / Capacidad')
                    ->schema([
                        Tabs::make('production_tabs')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                TextInput::make('production_title_es')->label('Título (ES)'),
                                Textarea::make('production_text_es')->label('Texto (ES)')->rows(3),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                TextInput::make('production_title_en')->label('Title (EN)'),
                                Textarea::make('production_text_en')->label('Text (EN)')->rows(3),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                TextInput::make('production_title_fr')->label('Titre (FR)'),
                                Textarea::make('production_text_fr')->label('Texte (FR)')->rows(3),
                            ]),
                        ]),
                    
                    ])->columns(1),

                Section::make('Video intermedio (antes de Soluciones)')
                    ->schema([
                        TextInput::make('solutions_video_url')
                            ->label('Video URL')
                            ->url()
                            ->nullable(),
                    ])->columns(1),


                /* ===================== SOLUCIONES ===================== */
                /* ===================== SOLUCIONES ===================== */
                Section::make('Soluciones de construcción')
                    ->schema([
                        Tabs::make('solutions_tabs')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                TextInput::make('solutions_title_es')->label('Título (ES)'),
                                Textarea::make('solutions_intro_es')->label('Intro (ES)')->rows(2),

                            ]),

                            Tabs\Tab::make('EN')->schema([
                                TextInput::make('solutions_title_en')->label('Title (EN)'),
                                Textarea::make('solutions_intro_en')->label('Intro (EN)')->rows(2),

                                
                            ]),

                            Tabs\Tab::make('FR')->schema([
                                TextInput::make('solutions_title_fr')->label('Titre (FR)'),
                                Textarea::make('solutions_intro_fr')->label('Intro (FR)')->rows(2),

                        
                            ]),

                            // ✅ Tab extra para Categorías destacadas
                            Tabs\Tab::make('Categorías')->schema([
                                Repeater::make('featured_categories_items')
                                    ->label('Categorías a mostrar (ordenable)')
                                    ->schema([
                                        Select::make('category_id')
                                            ->label('Categoría')
                                            ->searchable()
                                            ->required()
                                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                            ->options(function (Get $get) {
                                                $selectedIds = collect($get('../../featured_categories_items') ?? [])
                                                    ->pluck('category_id')
                                                    ->filter()
                                                    ->map(fn($v) => (int) $v)
                                                    ->values()
                                                    ->all();

                                                return Category::query()
                                                    ->when(count($selectedIds), fn($q) => $q->whereNotIn('id', $selectedIds))
                                                    ->orderBy('name')
                                                    ->pluck('name', 'id')
                                                    ->toArray();
                                            })
                                            ->preload(),
                                    ])
                                    ->reorderable()
                                    ->defaultItems(0)
                                    ->collapsed(),
                            ]),
                        ]),
                    ])
                    ->columns(1),


                /* ===================== INTERNACIONAL ===================== */
                Section::make('Internacional')
                    ->schema([
                        Tabs::make('international_tabs')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                TextInput::make('international_title_es')->label('Título (ES)'),
                                Textarea::make('international_text_es')->label('Texto (ES)')->rows(2),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                TextInput::make('international_title_en')->label('Title (EN)'),
                                Textarea::make('international_text_en')->label('Text (EN)')->rows(2),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                TextInput::make('international_title_fr')->label('Titre (FR)'),
                                Textarea::make('international_text_fr')->label('Texte (FR)')->rows(2),
                            ]),
                        ]),
                        Grid::make(3)->schema([
                            FileUpload::make('international_image')
                                ->label('Imagen (Internacional)')
                                ->image()
                                ->disk('public')
                                ->directory('empresa/international')
                                ->visibility('public')
                                ->preserveFilenames()
                                ->openable()
                                ->downloadable()
                                ->nullable(),

                            TextInput::make('international_image_title')->label('Imagen title')->nullable(),
                            TextInput::make('international_image_alt')->label('Imagen alt')->nullable(),
                        ]),
                    ])->columns(1),

                /* ===================== CERTIFICACIONES ===================== */
                Section::make('Certificaciones')
                    ->schema([
                        Tabs::make('certs_tabs')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                TextInput::make('certs_title_es')->label('Título (ES)'),
                                Textarea::make('certs_text_es')->label('Texto (ES)')->rows(2),
                                TextInput::make('certs_cta_text_es')->label('CTA texto (ES)')->nullable(),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                TextInput::make('certs_title_en')->label('Title (EN)'),
                                Textarea::make('certs_text_en')->label('Text (EN)')->rows(2),
                                TextInput::make('certs_cta_text_en')->label('CTA text (EN)')->nullable(),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                TextInput::make('certs_title_fr')->label('Titre (FR)'),
                                Textarea::make('certs_text_fr')->label('Texte (FR)')->rows(2),
                                TextInput::make('certs_cta_text_fr')->label('CTA texte (FR)')->nullable(),
                            ]),
                        ]),

                        TextInput::make('certs_cta_url')
                            ->label('CTA URL')
                            ->nullable()
                            ->helperText('Acepta URL completa (https://...) o ruta (/contacto).')
                            ->rule('regex:/^(https?:\/\/|\/).+/'),

                        Repeater::make('certs_logos')->label('Logos')
                            ->schema([
                                FileUpload::make('logo_url')
                                    ->label('Logo')
                                    ->image()
                                    ->disk('public')
                                    ->directory('empresa/certs')
                                    ->visibility('public')
                                    ->preserveFilenames()
                                    ->openable()
                                    ->downloadable()
                                    ->required(),

                                TextInput::make('title')->label('Logo title')->nullable(),
                                TextInput::make('alt')->label('Logo alt')->nullable(),
                            ])->collapsed()->addActionLabel('Agregar logo'),
                    ])
                    ->columns(1),


                /* ===================== CONSULTORÍA ===================== */
                Section::make('Consultoría personalizada')
                    ->schema([
                        Tabs::make('consulting_tabs')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                TextInput::make('consulting_title_es')->label('Título (ES)'),
                                Textarea::make('consulting_text_es')->label('Texto (ES)')->rows(2),
                                TextInput::make('consulting_cta_text_es')->label('CTA texto (ES)'),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                TextInput::make('consulting_title_en')->label('Title (EN)'),
                                Textarea::make('consulting_text_en')->label('Text (EN)')->rows(2),
                                TextInput::make('consulting_cta_text_en')->label('CTA text (EN)'),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                TextInput::make('consulting_title_fr')->label('Titre (FR)'),
                                Textarea::make('consulting_text_fr')->label('Texte (FR)')->rows(2),
                                TextInput::make('consulting_cta_text_fr')->label('CTA texte (FR)'),
                            ]),
                        ]),
                        Grid::make(4)->schema([
                            TextInput::make('consulting_cta_url')
                                ->label('CTA URL')
                                ->nullable()
                                ->helperText('Acepta URL completa (https://...) o ruta (/contacto).')
                                ->rule('regex:/^(https?:\/\/|\/).+/')
                                ->columnSpan(2),

                            FileUpload::make('consulting_bg_image')
                                ->label('BG imagen (Consultoría)')
                                ->image()
                                ->disk('public')
                                ->directory('empresa/consulting')
                                ->visibility('public')
                                ->preserveFilenames()
                                ->openable()
                                ->downloadable()
                                ->columnSpan(2)
                                ->nullable(),

                            TextInput::make('consulting_bg_image_title')->label('BG image title')->columnSpan(2),
                            TextInput::make('consulting_bg_image_alt')->label('BG image alt')->columnSpan(2),
                        ]),
                    ])->columns(1),

                Section::make('Fondo final (Bottom)')
                    ->schema([
                        FileUpload::make('bottom_bg_image')
                            ->label('BG final (Bottom)')
                            ->image()
                            ->disk('public')
                            ->directory('empresa/bottom')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->openable()
                            ->downloadable()
                            ->nullable(),

                        TextInput::make('bottom_bg_image_title')->label('BG title')->nullable(),
                        TextInput::make('bottom_bg_image_alt')->label('BG alt')->nullable(),
                    ])->columns(3),

            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')->label('Guardar')->submit('save')->color('primary'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $this->record->fill($data);
        $this->record->save();
        Notification::make()
            ->title('Cambios guardados satisfactoriamente')
            ->success()
            ->send();
    }
}
