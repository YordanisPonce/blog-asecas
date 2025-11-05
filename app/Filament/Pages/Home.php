<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Home as HomeModel;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Notifications\Notification;

class Home extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Sitio';
    protected static ?int $navigationSort = 10;
    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $title = 'Contenido de la Home';
    protected static string $view = 'filament.pages.home';

    public HomeModel $record;

    public ?array $data = [];

    public function mount(): void
    {
        // Singleton: siempre la primera fila (o crea una vacía)
        $this->record = HomeModel::first() ?? HomeModel::create([]);
        $this->form->fill($this->record->toArray());
    }

    /** 👇 Esto asegura que el form “conoce” su modelo */
    protected function getFormModel(): HomeModel
    {
        return $this->record;
    }

    // ... encabezado igual

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Hero / Primer bloque')->schema([
                \Filament\Forms\Components\Tabs::make('hero')->tabs([
                    \Filament\Forms\Components\Tabs\Tab::make('ES')->schema([
                        Textarea::make('first_description_es')->rows(3),
                    ]),
                    \Filament\Forms\Components\Tabs\Tab::make('EN')->schema([
                        Textarea::make('first_description_en')->rows(3),
                    ]),
                    \Filament\Forms\Components\Tabs\Tab::make('FR')->schema([
                        Textarea::make('first_description_fr')->rows(3),
                    ]),
                ]),
                Grid::make(4)->schema([
                    TextInput::make('first_image_url')->label('Imagen (URL)')->url()->columnSpan(2),
                    TextInput::make('first_image_title_es')->label('title (ES)'),
                    TextInput::make('first_image_alt_es')->label('alt (ES)'),
                    TextInput::make('first_image_title_en')->label('title (EN)'),
                    TextInput::make('first_image_alt_en')->label('alt (EN)'),
                    TextInput::make('first_image_title_fr')->label('title (FR)'),
                    TextInput::make('first_image_alt_fr')->label('alt (FR)'),
                ]),
            ]),

            Section::make('Segundo bloque')->schema([
                \Filament\Forms\Components\Tabs::make('second')->tabs([
                    \Filament\Forms\Components\Tabs\Tab::make('ES')->schema([
                        TextInput::make('second_title_es'),
                        Textarea::make('second_description_es')->rows(3),
                    ]),
                    \Filament\Forms\Components\Tabs\Tab::make('EN')->schema([
                        TextInput::make('second_title_en'),
                        Textarea::make('second_description_en')->rows(3),
                    ]),
                    \Filament\Forms\Components\Tabs\Tab::make('FR')->schema([
                        TextInput::make('second_title_fr'),
                        Textarea::make('second_description_fr')->rows(3),
                    ]),
                ]),
                Grid::make(4)->schema([
                    TextInput::make('second_image_url')->label('Imagen (URL)')->url()->columnSpan(2),
                    TextInput::make('second_image_title_es')->label('title (ES)'),
                    TextInput::make('second_image_alt_es')->label('alt (ES)'),
                    TextInput::make('second_image_title_en')->label('title (EN)'),
                    TextInput::make('second_image_alt_en')->label('alt (EN)'),
                    TextInput::make('second_image_title_fr')->label('title (FR)'),
                    TextInput::make('second_image_alt_fr')->label('alt (FR)'),
                ]),
            ]),

            // ---- CTA central (help) ----
            Section::make('CTA Central – Help')->schema([
                \Filament\Forms\Components\Tabs::make('cta_help')->tabs([
                    \Filament\Forms\Components\Tabs\Tab::make('ES')->schema([
                        TextInput::make('cta_help_title_es'),
                        Textarea::make('cta_help_text_es')->rows(3),
                        TextInput::make('cta_help_button_es')->label('Texto botón (ES)'),
                    ]),
                    \Filament\Forms\Components\Tabs\Tab::make('EN')->schema([
                        TextInput::make('cta_help_title_en'),
                        Textarea::make('cta_help_text_en')->rows(3),
                        TextInput::make('cta_help_button_en')->label('Button text (EN)'),
                    ]),
                    \Filament\Forms\Components\Tabs\Tab::make('FR')->schema([
                        TextInput::make('cta_help_title_fr'),
                        Textarea::make('cta_help_text_fr')->rows(3),
                        TextInput::make('cta_help_button_fr')->label('Texte du bouton (FR)'),
                    ]),
                ]),
                Grid::make(4)->schema([
                    TextInput::make('cta_help_url')->url()->label('URL del botón')->columnSpan(2),
                    TextInput::make('cta_help_image_url')->url()->label('Imagen BG (URL)')->columnSpan(2),
                    TextInput::make('cta_help_image_title')->label('BG title')->columnSpan(2),
                    TextInput::make('cta_help_image_alt')->label('BG alt')->columnSpan(2),
                ]),
            ]),

            // ---- Applications (3 tarjetas) ----
            Section::make('Applications (Home)')->schema([
                Repeater::make('applications_items')
                    ->helperText('Máximo 3 para el carrusel de la home')
                    ->maxItems(3)
                    ->schema([
                        TextInput::make('image_url')->label('Imagen (URL)')->url()->required(),
                        TextInput::make('image_title')->label('Imagen title'),
                        TextInput::make('image_alt')->label('Imagen alt'),
                        \Filament\Forms\Components\Tabs::make('app_i18n')->tabs([
                            \Filament\Forms\Components\Tabs\Tab::make('ES')->schema([TextInput::make('title_es')->label('Título (ES)')->required()]),
                            \Filament\Forms\Components\Tabs\Tab::make('EN')->schema([TextInput::make('title_en')->label('Title (EN)')->required()]),
                            \Filament\Forms\Components\Tabs\Tab::make('FR')->schema([TextInput::make('title_fr')->label('Titre (FR)')->required()]),
                        ]),
                        TextInput::make('link_url')->label('Enlace')->url(),
                    ])->collapsed()->addActionLabel('Agregar tarjeta'),
            ]),

            // ---- Finishes (tabs + cards) ----
            Section::make('Finishes (Home)')->schema([
                Repeater::make('finishes_tabs')
                    ->label('Pestañas')
                    ->schema([
                        \Filament\Forms\Components\Tabs::make('fin_tab_i18n')->tabs([
                            \Filament\Forms\Components\Tabs\Tab::make('ES')->schema([TextInput::make('tab_title_es')->label('Título pestaña (ES)')->required()]),
                            \Filament\Forms\Components\Tabs\Tab::make('EN')->schema([TextInput::make('tab_title_en')->label('Tab title (EN)')->required()]),
                            \Filament\Forms\Components\Tabs\Tab::make('FR')->schema([TextInput::make('tab_title_fr')->label('Titre onglet (FR)')->required()]),
                        ]),
                        Repeater::make('items')->label('Cards')->schema([
                            TextInput::make('icon_url')->label('Icono (URL)')->url()->required(),
                            TextInput::make('icon_title')->label('Icon title'),
                            TextInput::make('icon_alt')->label('Icon alt'),
                            \Filament\Forms\Components\Tabs::make('fin_i18n')->tabs([
                                \Filament\Forms\Components\Tabs\Tab::make('ES')->schema([TextInput::make('title_es')->label('Título (ES)')->required()]),
                                \Filament\Forms\Components\Tabs\Tab::make('EN')->schema([TextInput::make('title_en')->label('Title (EN)')->required()]),
                                \Filament\Forms\Components\Tabs\Tab::make('FR')->schema([TextInput::make('title_fr')->label('Titre (FR)')->required()]),
                            ]),
                            TextInput::make('link_url')->label('Enlace')->url(),
                        ])->collapsed(),
                    ])->collapsed()->addActionLabel('Agregar pestaña'),
            ]),

            // (Mantén tus secciones de Tercer bloque, Inspiración y Blog como ya las tienes)

            // ---- SEO ----
            Section::make('SEO (opcional)')->schema([
                \Filament\Forms\Components\Tabs::make('seo')->tabs([
                    \Filament\Forms\Components\Tabs\Tab::make('ES')->schema([
                        TextInput::make('seo_title_es')->maxLength(70),
                        TextInput::make('seo_description_es')->maxLength(300),
                    ]),
                    \Filament\Forms\Components\Tabs\Tab::make('EN')->schema([
                        TextInput::make('seo_title_en')->maxLength(70),
                        TextInput::make('seo_description_en')->maxLength(300),
                    ]),
                    \Filament\Forms\Components\Tabs\Tab::make('FR')->schema([
                        TextInput::make('seo_title_fr')->maxLength(70),
                        TextInput::make('seo_description_fr')->maxLength(300),
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

        // Recomendado: fill + save
        $this->record->fill($data);
        $this->record->save();
        Notification::make()
            ->title('Cambios guardados satisfactoriamente')
            ->success()
            ->send();

    }
}
