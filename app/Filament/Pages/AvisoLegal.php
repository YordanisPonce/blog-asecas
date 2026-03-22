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
                                                Textarea::make('ident_info_es')->rows(7),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                Textarea::make('ident_info_en')->rows(7),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                Textarea::make('ident_info_fr')->rows(7),
                                            ]),
                                        ]),
                                    ]),

                                Section::make('Intellectual Property Rights')
                                    ->schema([
                                        Tabs::make('ip_rights')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                Textarea::make('ip_rights_es')->rows(7),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                Textarea::make('ip_rights_en')->rows(7),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                Textarea::make('ip_rights_fr')->rows(7),
                                            ]),
                                        ]),
                                    ]),

                                Section::make('General Terms of Use')
                                    ->schema([
                                        Tabs::make('terms_use')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                Textarea::make('terms_use_es')->rows(7),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                Textarea::make('terms_use_en')->rows(7),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                Textarea::make('terms_use_fr')->rows(7),
                                            ]),
                                        ]),
                                    ]),

                                Section::make('Exclusion of Warranties and Liability')
                                    ->schema([
                                        Tabs::make('warranty_exclusion')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                Textarea::make('warranty_exclusion_es')->rows(7),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                Textarea::make('warranty_exclusion_en')->rows(7),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                Textarea::make('warranty_exclusion_fr')->rows(7),
                                            ]),
                                        ]),
                                    ]),

                                Section::make('Security Measures')
                                    ->schema([
                                        Tabs::make('security_measures')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                Textarea::make('security_measures_es')->rows(7),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                Textarea::make('security_measures_en')->rows(7),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                Textarea::make('security_measures_fr')->rows(7),
                                            ]),
                                        ]),
                                    ]),

                                Section::make('Modifications')
                                    ->schema([
                                        Tabs::make('modifications')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                Textarea::make('modifications_es')->rows(5),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                Textarea::make('modifications_en')->rows(5),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                Textarea::make('modifications_fr')->rows(5),
                                            ]),
                                        ]),
                                    ]),

                                Section::make('Applicable Law and Jurisdiction')
                                    ->schema([
                                        Tabs::make('applicable_law')->tabs([
                                            Tabs\Tab::make('ES')->schema([
                                                Textarea::make('applicable_law_es')->rows(5),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                Textarea::make('applicable_law_en')->rows(5),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                Textarea::make('applicable_law_fr')->rows(5),
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
