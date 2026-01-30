<?php

namespace App\Filament\Pages;

use App\Models\CertificationsDocumentationPage as PageModel;
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

class CertificationsDocumentation extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Sitio';
    protected static ?int $navigationSort = 40;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $title = 'Contenido – Certificaciones y documentación';
    protected static string $view = 'filament.pages.certifications-documentation';

    public PageModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = PageModel::first() ?? PageModel::create(['id' => 1]);

        $state = $this->record->toArray();

        // featured_categories (ids) => repeater items
        $state['featured_categories_items'] = collect($this->record->featured_categories ?? [])
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
            // ================= TITULO =================
            Section::make('Título')->schema([
                Tabs::make('title_lang')->tabs([
                    Tab::make('ES')->schema([
                        TextInput::make('title_es')->label('Título (ES)')->required(),
                    ]),
                    Tab::make('EN')->schema([
                        TextInput::make('title_en')->label('Title (EN)')->nullable(),
                    ]),
                    Tab::make('FR')->schema([
                        TextInput::make('title_fr')->label('Titre (FR)')->nullable(),
                    ]),
                ]),
            ]),

            // ================= DOCUMENTOS =================
            Section::make('Documentos (Descargables)')->schema([
                Repeater::make('documents')
                    ->label('Documentos')
                    ->reorderable()
                    ->defaultItems(0)
                    ->collapsed()
                    ->schema([
                        TextInput::make('key')
                            ->label('Key (única)')
                            ->helperText('Ej: certificado-aenor')
                            ->required()
                            ->maxLength(120),

                        Tabs::make('doc_titles')->tabs([
                            Tab::make('ES')->schema([
                                TextInput::make('title_es')->label('Título (ES)')->required(),
                            ]),
                            Tab::make('EN')->schema([
                                TextInput::make('title_en')->label('Title (EN)')->nullable(),
                            ]),
                            Tab::make('FR')->schema([
                                TextInput::make('title_fr')->label('Titre (FR)')->nullable(),
                            ]),
                        ]),

                        FileUpload::make('file_path')
                            ->label('Archivo')
                            ->disk('public')
                            ->directory('files')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->openable()
                            ->downloadable()
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            ])
                            ->maxSize(10240)
                            ->required(),
                    ])
                    ->itemLabel(fn(array $state): ?string => $state['title_es'] ?? $state['key'] ?? null),
            ]),

            // ================= SOLUCIONES + CATEGORIAS =================
            Section::make('Soluciones para la construcción')->schema([
                Tabs::make('solutions_lang')->tabs([
                    Tab::make('ES')->schema([
                        TextInput::make('solutions_title_es')->label('Título (ES)')->nullable(),
                        Textarea::make('solutions_description_es')->label('Descripción (ES)')->rows(2)->nullable(),
                    ]),
                    Tab::make('EN')->schema([
                        TextInput::make('solutions_title_en')->label('Title (EN)')->nullable(),
                        Textarea::make('solutions_description_en')->label('Description (EN)')->rows(2)->nullable(),
                    ]),
                    Tab::make('FR')->schema([
                        TextInput::make('solutions_title_fr')->label('Titre (FR)')->nullable(),
                        Textarea::make('solutions_description_fr')->label('Description (FR)')->rows(2)->nullable(),
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
