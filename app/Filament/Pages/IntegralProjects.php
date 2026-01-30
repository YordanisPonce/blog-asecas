<?php

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
        $this->form->fill($this->record->toArray());
    }

    protected function getFormModel(): PageModel
    {
        return $this->record;
    }

    public function form(Form $form): Form
    {
        return $form->schema([

            Section::make('Hero')->schema([
                Grid::make(1)->schema([
                    Tabs::make('hero_lang')->tabs([
                        Tab::make('ES')->schema([
                            Textarea::make('hero_title_es')->label('Título (ES)')->rows(2)
                                ->helperText('Puede contener HTML.'),
                            // Textarea::make('hero_description_es')->label('Descripción (ES)')->rows(2),
                            // TextInput::make('hero_image_title_es')->label('Imagen title (ES)'),
                            TextInput::make('hero_image_alt_es')->label('Imagen alt (ES)'),
                        ]),
                        Tab::make('EN')->schema([
                            Textarea::make('hero_title_en')->label('Title (EN)')->rows(2),
                            // Textarea::make('hero_description_en')->label('Description (EN)')->rows(2),
                            // TextInput::make('hero_image_title_en')->label('Image title (EN)'),
                            TextInput::make('hero_image_alt_en')->label('Image alt (EN)'),
                        ]),
                        Tab::make('FR')->schema([
                            Textarea::make('hero_title_fr')->label('Titre (FR)')->rows(2),
                            // Textarea::make('hero_description_fr')->label('Description (FR)')->rows(2),
                            // TextInput::make('hero_image_title_fr')->label('Image title (FR)'),
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

            // Section::make('Bloque – 3 columnas')->schema([
            //     Tabs::make('cols')->tabs([
            //         Tab::make('Columna 1')->schema([
            //             Tabs::make('col1_lang')->tabs([
            //                 Tab::make('ES')->schema([
            //                     TextInput::make('col1_title_es')->label('Título (ES)'),
            //                     Textarea::make('col1_text_es')->label('Texto (ES)')->rows(3),
            //                     Textarea::make('col1_bullets_es')->label('Bullets (ES)')->rows(4)->nullable(),
            //                 ]),
            //                 Tab::make('EN')->schema([
            //                     TextInput::make('col1_title_en')->label('Title (EN)'),
            //                     Textarea::make('col1_text_en')->label('Text (EN)')->rows(3),
            //                     Textarea::make('col1_bullets_en')->label('Bullets (EN)')->rows(4)->nullable(),
            //                 ]),
            //                 Tab::make('FR')->schema([
            //                     TextInput::make('col1_title_fr')->label('Titre (FR)'),
            //                     Textarea::make('col1_text_fr')->label('Texte (FR)')->rows(3),
            //                     Textarea::make('col1_bullets_fr')->label('Bullets (FR)')->rows(4)->nullable(),
            //                 ]),
            //             ]),
            //         ]),

            //         Tab::make('Columna 2')->schema([
            //             Tabs::make('col2_lang')->tabs([
            //                 Tab::make('ES')->schema([
            //                     TextInput::make('col2_title_es')->label('Título (ES)'),
            //                     Textarea::make('col2_text_es')->label('Texto (ES)')->rows(3),
            //                     Textarea::make('col2_bullets_es')->label('Bullets (ES)')->rows(4)->nullable(),
            //                 ]),
            //                 Tab::make('EN')->schema([
            //                     TextInput::make('col2_title_en')->label('Title (EN)'),
            //                     Textarea::make('col2_text_en')->label('Text (EN)')->rows(3),
            //                     Textarea::make('col2_bullets_en')->label('Bullets (EN)')->rows(4)->nullable(),
            //                 ]),
            //                 Tab::make('FR')->schema([
            //                     TextInput::make('col2_title_fr')->label('Titre (FR)'),
            //                     Textarea::make('col2_text_fr')->label('Texte (FR)')->rows(3),
            //                     Textarea::make('col2_bullets_fr')->label('Bullets (FR)')->rows(4)->nullable(),
            //                 ]),
            //             ]),
            //         ]),

            //         Tab::make('Columna 3')->schema([
            //             Tabs::make('col3_lang')->tabs([
            //                 Tab::make('ES')->schema([
            //                     TextInput::make('col3_title_es')->label('Título (ES)'),
            //                     Textarea::make('col3_text_es')->label('Texto (ES)')->rows(3),
            //                     Textarea::make('col3_bullets_es')->label('Bullets (ES)')->rows(4)->nullable(),
            //                 ]),
            //                 Tab::make('EN')->schema([
            //                     TextInput::make('col3_title_en')->label('Title (EN)'),
            //                     Textarea::make('col3_text_en')->label('Text (EN)')->rows(3),
            //                     Textarea::make('col3_bullets_en')->label('Bullets (EN)')->rows(4)->nullable(),
            //                 ]),
            //                 Tab::make('FR')->schema([
            //                     TextInput::make('col3_title_fr')->label('Titre (FR)'),
            //                     Textarea::make('col3_text_fr')->label('Texte (FR)')->rows(3),
            //                     Textarea::make('col3_bullets_fr')->label('Bullets (FR)')->rows(4)->nullable(),
            //                 ]),
            //             ]),
            //         ]),
            //     ]),
            // ]),

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

            Section::make('SEO (opcional)')->schema([
                Tabs::make('seo_lang')->tabs([
                    Tab::make('ES')->schema([
                        TextInput::make('seo_title_es')->maxLength(70)->label('SEO title (ES)'),
                        Textarea::make('seo_description_es')->maxLength(300)->rows(2)->label('SEO description (ES)'),
                    ]),
                    Tab::make('EN')->schema([
                        TextInput::make('seo_title_en')->maxLength(70)->label('SEO title (EN)'),
                        Textarea::make('seo_description_en')->maxLength(300)->rows(2)->label('SEO description (EN)'),
                    ]),
                    Tab::make('FR')->schema([
                        TextInput::make('seo_title_fr')->maxLength(70)->label('SEO title (FR)'),
                        Textarea::make('seo_description_fr')->maxLength(300)->rows(2)->label('SEO description (FR)'),
                    ]),
                ]),
            ]),

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

        $this->record->fill($data);
        $this->record->save();

        Notification::make()
            ->title('Cambios guardados satisfactoriamente')
            ->success()
            ->send();
    }
}
