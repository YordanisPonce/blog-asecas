<?php

namespace App\Filament\Pages;

use App\Models\ApplicatorsPage as PageModel;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Applicators extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Sitio';
    protected static ?int $navigationSort = 31;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $title = 'Contenido – Aplicadores';
    protected static string $view = 'filament.pages.applicators';

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
                Tabs::make('hero_lang')->tabs([
                    Tab::make('ES')->schema([
                        Textarea::make('hero_title_es')->label('Título (ES)')->rows(2)
                            ->helperText('Puede contener HTML (ej: <span style="color:#d32f2f;">...</span>)'),
                        // Textarea::make('hero_description_es')->label('Descripción (ES)')->rows(2),
                        TextInput::make('hero_image_alt_es')->label('Imagen alt (ES)'),
                        // TextInput::make('hero_image_title_es')->label('Imagen title (ES)'),
                    ]),
                    Tab::make('EN')->schema([
                        Textarea::make('hero_title_en')->label('Title (EN)')->rows(2),
                        // Textarea::make('hero_description_en')->label('Description (EN)')->rows(2),
                        TextInput::make('hero_image_alt_en')->label('Image alt (EN)'),
                        // TextInput::make('hero_image_title_en')->label('Image title (EN)'),
                    ]),
                    Tab::make('FR')->schema([
                        Textarea::make('hero_title_fr')->label('Titre (FR)')->rows(2),
                        // Textarea::make('hero_description_fr')->label('Description (FR)')->rows(2),
                        TextInput::make('hero_image_alt_fr')->label('Image alt (FR)'),
                        // TextInput::make('hero_image_title_fr')->label('Image title (FR)'),
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

            Section::make('Bloque – 3 columnas')->schema([
                Tabs::make('cols')->tabs([
                    Tab::make('Columna 1')->schema([
                        Tabs::make('col1_lang')->tabs([
                            Tab::make('ES')->schema([
                                TextInput::make('col1_title_es')->label('Título (ES)'),
                                Textarea::make('col1_text_es')->label('Texto (ES)')->rows(2),
                                Textarea::make('col1_bullets_es')->label('Bullets (ES)')->rows(4),
                            ]),
                            Tab::make('EN')->schema([
                                TextInput::make('col1_title_en')->label('Title (EN)'),
                                Textarea::make('col1_text_en')->label('Text (EN)')->rows(2),
                                Textarea::make('col1_bullets_en')->label('Bullets (EN)')->rows(4),
                            ]),
                            Tab::make('FR')->schema([
                                TextInput::make('col1_title_fr')->label('Titre (FR)'),
                                Textarea::make('col1_text_fr')->label('Texte (FR)')->rows(2),
                                Textarea::make('col1_bullets_fr')->label('Bullets (FR)')->rows(4),
                            ]),
                        ]),
                    ]),
                    Tab::make('Columna 2')->schema([
                        Tabs::make('col2_lang')->tabs([
                            Tab::make('ES')->schema([
                                TextInput::make('col2_title_es')->label('Título (ES)'),
                                Textarea::make('col2_text_es')->label('Texto (ES)')->rows(2),
                                Textarea::make('col2_bullets_es')->label('Bullets (ES)')->rows(4),
                            ]),
                            Tab::make('EN')->schema([
                                TextInput::make('col2_title_en')->label('Title (EN)'),
                                Textarea::make('col2_text_en')->label('Text (EN)')->rows(2),
                                Textarea::make('col2_bullets_en')->label('Bullets (EN)')->rows(4),
                            ]),
                            Tab::make('FR')->schema([
                                TextInput::make('col2_title_fr')->label('Titre (FR)'),
                                Textarea::make('col2_text_fr')->label('Texte (FR)')->rows(2),
                                Textarea::make('col2_bullets_fr')->label('Bullets (FR)')->rows(4),
                            ]),
                        ]),
                    ]),
                    Tab::make('Columna 3')->schema([
                        Tabs::make('col3_lang')->tabs([
                            Tab::make('ES')->schema([
                                TextInput::make('col3_title_es')->label('Título (ES)'),
                                Textarea::make('col3_text_es')->label('Texto (ES)')->rows(2),
                                Textarea::make('col3_bullets_es')->label('Bullets (ES)')->rows(4),
                            ]),
                            Tab::make('EN')->schema([
                                TextInput::make('col3_title_en')->label('Title (EN)'),
                                Textarea::make('col3_text_en')->label('Text (EN)')->rows(2),
                                Textarea::make('col3_bullets_en')->label('Bullets (EN)')->rows(4),
                            ]),
                            Tab::make('FR')->schema([
                                TextInput::make('col3_title_fr')->label('Titre (FR)'),
                                Textarea::make('col3_text_fr')->label('Texte (FR)')->rows(2),
                                Textarea::make('col3_bullets_fr')->label('Bullets (FR)')->rows(4),
                            ]),
                        ]),
                    ]),
                ]),
            ]),

            Section::make('Imagen Banner')->schema([
                Tabs::make('banner_lang')->tabs([
                    Tab::make('ES')->schema([
                        TextInput::make('banner_image_alt_es')->label('Imagen alt (ES)'),
                        // TextInput::make('banner_image_title_es')->label('Imagen title (ES)'),
                    ]),
                    Tab::make('EN')->schema([
                        TextInput::make('banner_image_alt_en')->label('Image alt (EN)'),
                        // TextInput::make('banner_image_title_en')->label('Image title (EN)'),
                    ]),
                    Tab::make('FR')->schema([
                        TextInput::make('banner_image_alt_fr')->label('Image alt (FR)'),
                        // TextInput::make('banner_image_title_fr')->label('Image title (FR)'),
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

            Section::make('Bloque Final – Texto + Formulario')->schema([
                Tabs::make('final_lang')->tabs([
                    Tab::make('ES')->schema([
                        TextInput::make('final_title_es')->label('Título (ES)'),
                        Textarea::make('final_description_es')->label('Descripción (ES)')->rows(3)
                            ->helperText('Puede contener HTML.'),
                        Textarea::make('form_privacy_es')->label('Texto legal (ES)')->rows(6),
                        Textarea::make('form_checkbox1_es')->label('Checkbox 1 (ES)')->rows(2),
                        Textarea::make('form_checkbox2_es')->label('Checkbox 2 (ES)')->rows(2),
                    ]),
                    Tab::make('EN')->schema([
                        TextInput::make('final_title_en')->label('Title (EN)'),
                        Textarea::make('final_description_en')->label('Description (EN)')->rows(3),
                        Textarea::make('form_privacy_en')->label('Legal text (EN)')->rows(6),
                        Textarea::make('form_checkbox1_en')->label('Checkbox 1 (EN)')->rows(2),
                        Textarea::make('form_checkbox2_en')->label('Checkbox 2 (EN)')->rows(2),
                    ]),
                    Tab::make('FR')->schema([
                        TextInput::make('final_title_fr')->label('Titre (FR)'),
                        Textarea::make('final_description_fr')->label('Description (FR)')->rows(3),
                        Textarea::make('form_privacy_fr')->label('Texte légal (FR)')->rows(6),
                        Textarea::make('form_checkbox1_fr')->label('Checkbox 1 (FR)')->rows(2),
                        Textarea::make('form_checkbox2_fr')->label('Checkbox 2 (FR)')->rows(2),
                    ]),
                ]),

                Repeater::make('benefits')
                    ->label('Beneficios (lista izquierda)')
                    ->schema([
                        Tabs::make('benefit_lang')->tabs([
                            Tab::make('ES')->schema([
                                TextInput::make('title_es')->label('Título (ES)')->required(),
                                Textarea::make('text_es')->label('Texto (ES)')->rows(2)->required(),
                            ]),
                            Tab::make('EN')->schema([
                                TextInput::make('title_en')->label('Title (EN)'),
                                Textarea::make('text_en')->label('Text (EN)')->rows(2),
                            ]),
                            Tab::make('FR')->schema([
                                TextInput::make('title_fr')->label('Titre (FR)'),
                                Textarea::make('text_fr')->label('Texte (FR)')->rows(2),
                            ]),
                        ]),
                    ])
                    ->reorderable()
                    ->defaultItems(0)
                    ->collapsed(),
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
