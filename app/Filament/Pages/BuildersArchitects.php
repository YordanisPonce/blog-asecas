<?php

namespace App\Filament\Pages;

use App\Models\BuildersArchitectsPage as PageModel;
use App\Models\Category;
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
use Filament\Forms\Get;
use Filament\Forms\Components\Select;

class BuildersArchitects extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Sitio';
    protected static ?int $navigationSort = 30;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $title = 'Contenido – Constructores y Arquitectos';
    protected static string $view = 'filament.pages.builders-architects';

    public PageModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = PageModel::first() ?? PageModel::create(['id' => 1]);

        $state = $this->record->toArray();

        // featured_products (ids) => repeater items
        $state['featured_categories_items'] = collect($this->record->featured_categories  ?? [])
            ->map(fn($id) => ['category_id' => $id])
            ->values()
            ->all();

        $this->form->fill($state);
    }

    protected function getFormModel(): PageModel
    {
        return $this->record;
    }

    public function form(Form $form): Form
    {
        return $form->schema([

            // ================= HERO =================
            Section::make('Hero')->schema([
                Grid::make(1)->schema([
                    Tabs::make('hero_lang')->tabs([
                        Tab::make('ES')->schema([
                            Textarea::make('hero_title_es')
                                ->label('Título (ES)')
                                ->helperText('Puede contener HTML (ej: <span style="color:red">...</span>)')
                                ->rows(2),
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

            // ================= 3 COLUMNAS =================
            Section::make('Bloque – 3 columnas')->schema([
                Tabs::make('cols')->tabs([
                    Tab::make('Columna 1')->schema([
                        Tabs::make('col1_lang')->tabs([
                            Tab::make('ES')->schema([
                                TextInput::make('col1_title_es')->label('Título (ES)'),
                                Textarea::make('col1_text_es')->label('Texto (ES)')->rows(2),
                                Textarea::make('col1_bullets_es')
                                    ->label('Bullets (ES)')
                                    ->helperText('Puedes poner saltos de línea o HTML.')
                                    ->rows(5),
                            ]),
                            Tab::make('EN')->schema([
                                TextInput::make('col1_title_en')->label('Title (EN)'),
                                Textarea::make('col1_text_en')->label('Text (EN)')->rows(2),
                                Textarea::make('col1_bullets_en')->label('Bullets (EN)')->rows(5),
                            ]),
                            Tab::make('FR')->schema([
                                TextInput::make('col1_title_fr')->label('Titre (FR)'),
                                Textarea::make('col1_text_fr')->label('Texte (FR)')->rows(2),
                                Textarea::make('col1_bullets_fr')->label('Bullets (FR)')->rows(5),
                            ]),
                        ]),
                    ]),

                    Tab::make('Columna 2')->schema([
                        Tabs::make('col2_lang')->tabs([
                            Tab::make('ES')->schema([
                                TextInput::make('col2_title_es')->label('Título (ES)'),
                                Textarea::make('col2_text_es')->label('Texto (ES)')->rows(2),
                                Textarea::make('col2_bullets_es')
                                    ->label('Bullets (ES)')
                                    ->helperText('Puedes poner saltos de línea o HTML.')
                                    ->rows(5),
                            ]),
                            Tab::make('EN')->schema([
                                TextInput::make('col2_title_en')->label('Title (EN)'),
                                Textarea::make('col2_text_en')->label('Text (EN)')->rows(2),
                                Textarea::make('col2_bullets_en')->label('Bullets (EN)')->rows(5),
                            ]),
                            Tab::make('FR')->schema([
                                TextInput::make('col2_title_fr')->label('Titre (FR)'),
                                Textarea::make('col2_text_fr')->label('Texte (FR)')->rows(2),
                                Textarea::make('col2_bullets_fr')->label('Bullets (FR)')->rows(5),
                            ]),
                        ]),
                    ]),

                    Tab::make('Columna 3')->schema([
                        Tabs::make('col3_lang')->tabs([
                            Tab::make('ES')->schema([
                                TextInput::make('col3_title_es')->label('Título (ES)'),
                                Textarea::make('col3_text_es')->label('Texto (ES)')->rows(2),
                                Textarea::make('col3_bullets_es')
                                    ->label('Bullets (ES)')
                                    ->helperText('Puedes poner saltos de línea o HTML.')
                                    ->rows(5),
                            ]),
                            Tab::make('EN')->schema([
                                TextInput::make('col3_title_en')->label('Title (EN)'),
                                Textarea::make('col3_text_en')->label('Text (EN)')->rows(2),
                                Textarea::make('col3_bullets_en')->label('Bullets (EN)')->rows(5),
                            ]),
                            Tab::make('FR')->schema([
                                TextInput::make('col3_title_fr')->label('Titre (FR)'),
                                Textarea::make('col3_text_fr')->label('Texte (FR)')->rows(2),
                                Textarea::make('col3_bullets_fr')->label('Bullets (FR)')->rows(5),
                            ]),
                        ]),
                    ]),
                ]),
            ]),

            // ================= BANNER =================
            Section::make('Imagen Banner')->schema([
                Tabs::make('banner_lang')->tabs([
                    Tab::make('ES')->schema([
                        TextInput::make('banner_image_alt_es')->label('Imagen alt (ES)'),
                    ]),
                    Tab::make('EN')->schema([
                        TextInput::make('banner_image_alt_en')->label('Image alt (EN)'),
                    ]),
                    Tab::make('FR')->schema([
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

            // ================= FINAL + PRODUCTOS =================
            Section::make('Bloque Final + Categorias')->schema([
                Tabs::make('final_lang')->tabs([
                    Tab::make('ES')->schema([
                        TextInput::make('final_title_es')->label('Título (ES)'),
                        Textarea::make('final_description_es')
                            ->label('Descripción (ES)')
                            ->helperText('Puede contener HTML.')
                            ->rows(3),
                    ]),
                    Tab::make('EN')->schema([
                        TextInput::make('final_title_en')->label('Title (EN)'),
                        Textarea::make('final_description_en')
                            ->label('Description (EN)')
                            ->helperText('Can contain HTML.')
                            ->rows(3),
                    ]),
                    Tab::make('FR')->schema([
                        TextInput::make('final_title_fr')->label('Titre (FR)'),
                        Textarea::make('final_description_fr')
                            ->label('Description (FR)')
                            ->helperText('Peut contenir du HTML.')
                            ->rows(3),
                    ]),
                ]),

                Repeater::make('featured_categories_items')
                    ->label('Categorías a mostrar (ordenable)')
                    ->schema([
                        Select::make('category_id')
                            ->label('Categoría')
                            ->searchable()
                            ->required()
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->options(function (Get $get) {
                                // Estado actual del repeater
                                $selectedIds = collect($get('../../featured_categories_items') ?? [])
                                    ->pluck('category_id')
                                    ->filter()
                                    ->map(fn($v) => (int) $v)
                                    ->values()
                                    ->all();

                                // Mostrar SOLO las que aún NO están seleccionadas
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

            // ================= SEO =================
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

        $items = collect($data['featured_categories_items'] ?? [])
            ->pluck('category_id')
            ->filter()
            ->map(fn($v) => (int) $v)
            ->unique()
            ->values()
            ->all();

        $data['featured_categories'] = $items;
        unset($data['featured_categories_items']);

        $this->record->fill($data);
        $this->record->save();

        Notification::make()
            ->title('Cambios guardados satisfactoriamente')
            ->success()
            ->send();
    }
}
