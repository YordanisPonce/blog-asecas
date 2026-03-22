<?php
// app/Filament/Pages/Privacidad.php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\PrivacyPage as PrivacyModel;
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

class Privacidad extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationLabel = 'Política de Privacidad';
    protected static ?string $title = 'Contenido – Política de Privacidad';
    protected static string $view = 'filament.pages.privacidad';

    protected static ?string $navigationGroup = 'Legal';
    protected static ?int $navigationSort = 20;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    public PrivacyModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = PrivacyModel::first() ?? PrivacyModel::create([]);

        // Cargar datos del modelo + SEO
        $this->form->fill([
            ...$this->record->toArray(),
            'seo' => $this->record->seo?->toArray() ?? [], // ← CARGAR SEO
        ]);
    }

    protected function getFormModel(): PrivacyModel
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
                                                    ->placeholder('Política de Privacidad'),
                                            ]),
                                            Tabs\Tab::make('EN')->schema([
                                                TextInput::make('page_title_en')->label('Title (EN)')
                                                    ->placeholder('Privacy Policy'),
                                            ]),
                                            Tabs\Tab::make('FR')->schema([
                                                TextInput::make('page_title_fr')->label('Titre (FR)')
                                                    ->placeholder('Politique de confidentialité'),
                                            ]),
                                        ]),
                                        Grid::make(3)->schema([
                                            DatePicker::make('last_updated_at')->label('Última actualización')->native(false),
                                        ]),
                                    ])->columns(1),

                                Section::make('Introducción')
                                    ->schema([
                                        Tabs::make('intro')->tabs([
                                            Tabs\Tab::make('ES')->schema([Textarea::make('intro_es')->rows(6)]),
                                            Tabs\Tab::make('EN')->schema([Textarea::make('intro_en')->rows(6)]),
                                            Tabs\Tab::make('FR')->schema([Textarea::make('intro_fr')->rows(6)]),
                                        ]),
                                    ]),

                                Section::make('Responsable del tratamiento')
                                    ->schema([
                                        Tabs::make('controller_info')->tabs([
                                            Tabs\Tab::make('ES')->schema([Textarea::make('controller_info_es')->rows(6)]),
                                            Tabs\Tab::make('EN')->schema([Textarea::make('controller_info_en')->rows(6)]),
                                            Tabs\Tab::make('FR')->schema([Textarea::make('controller_info_fr')->rows(6)]),
                                        ]),
                                    ]),

                                Section::make('Finalidad del tratamiento')
                                    ->schema([
                                        Tabs::make('purpose')->tabs([
                                            Tabs\Tab::make('ES')->schema([Textarea::make('purpose_es')->rows(6)]),
                                            Tabs\Tab::make('EN')->schema([Textarea::make('purpose_en')->rows(6)]),
                                            Tabs\Tab::make('FR')->schema([Textarea::make('purpose_fr')->rows(6)]),
                                        ]),
                                    ]),

                                Section::make('Base legal')
                                    ->schema([
                                        Tabs::make('legal_basis')->tabs([
                                            Tabs\Tab::make('ES')->schema([Textarea::make('legal_basis_es')->rows(6)]),
                                            Tabs\Tab::make('EN')->schema([Textarea::make('legal_basis_en')->rows(6)]),
                                            Tabs\Tab::make('FR')->schema([Textarea::make('legal_basis_fr')->rows(6)]),
                                        ]),
                                    ]),

                                Section::make('Medidas de seguridad')
                                    ->schema([
                                        Tabs::make('security_measures')->tabs([
                                            Tabs\Tab::make('ES')->schema([Textarea::make('security_measures_es')->rows(6)]),
                                            Tabs\Tab::make('EN')->schema([Textarea::make('security_measures_en')->rows(6)]),
                                            Tabs\Tab::make('FR')->schema([Textarea::make('security_measures_fr')->rows(6)]),
                                        ]),
                                    ]),

                                Section::make('Comunicación de datos a terceros')
                                    ->schema([
                                        Tabs::make('data_sharing')->tabs([
                                            Tabs\Tab::make('ES')->schema([Textarea::make('data_sharing_es')->rows(6)]),
                                            Tabs\Tab::make('EN')->schema([Textarea::make('data_sharing_en')->rows(6)]),
                                            Tabs\Tab::make('FR')->schema([Textarea::make('data_sharing_fr')->rows(6)]),
                                        ]),
                                    ]),

                                Section::make('Transferencias internacionales')
                                    ->schema([
                                        Tabs::make('intl_transfers')->tabs([
                                            Tabs\Tab::make('ES')->schema([Textarea::make('intl_transfers_es')->rows(6)]),
                                            Tabs\Tab::make('EN')->schema([Textarea::make('intl_transfers_en')->rows(6)]),
                                            Tabs\Tab::make('FR')->schema([Textarea::make('intl_transfers_fr')->rows(6)]),
                                        ]),
                                    ]),

                                Section::make('Plazos de conservación')
                                    ->schema([
                                        Tabs::make('retention')->tabs([
                                            Tabs\Tab::make('ES')->schema([Textarea::make('retention_es')->rows(6)]),
                                            Tabs\Tab::make('EN')->schema([Textarea::make('retention_en')->rows(6)]),
                                            Tabs\Tab::make('FR')->schema([Textarea::make('retention_fr')->rows(6)]),
                                        ]),
                                    ]),

                                Section::make('Cómo ejercer tus derechos')
                                    ->schema([
                                        Tabs::make('rights_howto')->tabs([
                                            Tabs\Tab::make('ES')->schema([Textarea::make('rights_howto_es')->rows(8)]),
                                            Tabs\Tab::make('EN')->schema([Textarea::make('rights_howto_en')->rows(8)]),
                                            Tabs\Tab::make('FR')->schema([Textarea::make('rights_howto_fr')->rows(8)]),
                                        ]),
                                    ]),

                                Section::make('Modificaciones de esta información')
                                    ->schema([
                                        Tabs::make('modifications')->tabs([
                                            Tabs\Tab::make('ES')->schema([Textarea::make('modifications_es')->rows(4)]),
                                            Tabs\Tab::make('EN')->schema([Textarea::make('modifications_en')->rows(4)]),
                                            Tabs\Tab::make('FR')->schema([Textarea::make('modifications_fr')->rows(4)]),
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
