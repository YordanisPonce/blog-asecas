<?php
// app/Filament/Pages/AvisoLegal.php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\LegalPage as LegalModel;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use App\Filament\Components\SeoFields; // ← IMPORTAR EL COMPONENTE SEO

class AvisoLegal extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Legal';
    protected static ?int $navigationSort = 10;
    protected static ?string $navigationIcon = 'heroicon-o-scale';
    protected static ?string $title = 'Contenido – Aviso Legal';
    protected static string $view = 'filament.pages.aviso-legal';

    public LegalModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = LegalModel::first() ?? LegalModel::create([]);

        // Cargar datos del modelo + SEO
        $this->form->fill([
            ...$this->record->toArray(),
            'seo' => $this->record->seo?->toArray() ?? [], // ← CARGAR SEO
        ]);
    }

    protected function getFormModel(): LegalModel
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

                                Section::make('Título de la página')
                                    ->schema([
                                        Tabs::make('page_titles')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                TextInput::make('page_title_es')->label('Título (ES)')
                                                    ->placeholder('Aviso Legal'),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                TextInput::make('page_title_en')->label('Title (EN)')
                                                    ->placeholder('Legal Notice'),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                TextInput::make('page_title_fr')->label('Titre (FR)')
                                                    ->placeholder('Mentions légales'),
                                            ]),
                                        ]),
                                        Grid::make(3)->schema([
                                            DatePicker::make('last_updated_at')->label('Última actualización')->native(false),
                                        ]),
                                    ])->columns(1),

                                Section::make('Identifying Information')
                                    ->schema([
                                        Tabs::make('ident_info')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                RichEditor::make('ident_info_es'),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                RichEditor::make('ident_info_en'),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                RichEditor::make('ident_info_fr'),
                                            ]),
                                        ]),
                                    ]),

                                Section::make('Intellectual Property Rights')
                                    ->schema([
                                        Tabs::make('ip_rights')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                RichEditor::make('ip_rights_es'),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                RichEditor::make('ip_rights_en'),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                RichEditor::make('ip_rights_fr'),
                                            ]),
                                        ]),
                                    ]),

                                Section::make('General Terms of Use')
                                    ->schema([
                                        Tabs::make('terms_use')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                RichEditor::make('terms_use_es'),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                RichEditor::make('terms_use_en'),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                RichEditor::make('terms_use_fr'),
                                            ]),
                                        ]),
                                    ]),

                                Section::make('Exclusion of Warranties and Liability')
                                    ->schema([
                                        Tabs::make('warranty_exclusion')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                RichEditor::make('warranty_exclusion_es'),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                RichEditor::make('warranty_exclusion_en'),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                RichEditor::make('warranty_exclusion_fr'),
                                            ]),
                                        ]),
                                    ]),

                                Section::make('Security Measures')
                                    ->schema([
                                        Tabs::make('security_measures')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                RichEditor::make('security_measures_es'),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                RichEditor::make('security_measures_en'),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                RichEditor::make('security_measures_fr'),
                                            ]),
                                        ]),
                                    ]),

                                Section::make('Modifications')
                                    ->schema([
                                        Tabs::make('modifications')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                RichEditor::make('modifications_es'),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                RichEditor::make('modifications_en'),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                RichEditor::make('modifications_fr'),
                                            ]),
                                        ]),
                                    ]),

                                Section::make('Applicable Law and Jurisdiction')
                                    ->schema([
                                        Tabs::make('applicable_law')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                RichEditor::make('applicable_law_es'),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                RichEditor::make('applicable_law_en'),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                RichEditor::make('applicable_law_fr'),
                                            ]),
                                        ]),
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
