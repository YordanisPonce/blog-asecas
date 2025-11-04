<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\ContactPage as ContactModel;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;

class Contacto extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';
    protected static ?string $navigationLabel = 'Contacto';
    protected static ?string $title = 'Contenido – Contacto';
    protected static ?string $navigationGroup = 'Contenido';
    protected static string $view = 'filament.pages.contacto';

    public ContactModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = ContactModel::first() ?? ContactModel::create([]);
        $this->form->fill($this->record->toArray());
    }

    protected function getFormModel(): ContactModel
    {
        return $this->record;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                /* ===== MAPA ===== */
                Section::make('Mapa')
                    ->schema([
                        TextInput::make('map_embed_url')
                            ->label('URL de mapa (embed)')
                            ->placeholder('https://www.google.com/maps/embed?...')
                            ->url(),
                    ]),

                /* ===== DATOS DE CONTACTO ===== */
                Section::make('Datos de contacto')
                    ->schema([
                        Tabs::make('contact_titles')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                TextInput::make('contact_title_es')->label('Título (ES)')->placeholder('Contacto'),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                TextInput::make('contact_title_en')->label('Title (EN)')->placeholder('Contact'),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                TextInput::make('contact_title_fr')->label('Titre (FR)')->placeholder('Contact'),
                            ]),
                        ]),
                        Grid::make(4)->schema([
                            TextInput::make('address_line')->label('Dirección'),
                            TextInput::make('city')->label('Ciudad/CP'),
                            TextInput::make('region')->label('Región/Provincia'),
                            TextInput::make('country')->label('País'),
                        ]),

                        Grid::make(2)->schema([
                            Repeater::make('phones')->label('Teléfonos')
                                ->schema([
                                    TextInput::make('label')->label('Etiqueta')->placeholder('+34'),
                                    TextInput::make('number')->label('Número')->placeholder('+34 968 862 643'),
                                ])->collapsed()->addActionLabel('Añadir teléfono'),

                            Repeater::make('emails')->label('Emails')
                                ->schema([
                                    TextInput::make('label')->label('Etiqueta')->placeholder('info'),
                                    TextInput::make('email')->label('Email')->email()->placeholder('hello@empresa.com'),
                                ])->collapsed()->addActionLabel('Añadir email'),
                        ]),
                    ])->columns(1),

                /* ===== HORARIO ===== */
                Section::make('Horario')
                    ->schema([
                        Tabs::make('schedule_tabs')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                Textarea::make('schedule_text_es')->rows(4)->placeholder("Lunes–Jueves: 08:00–15:00\nViernes: 08:00–14:00\nVerano: 07:00–15:00"),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                Textarea::make('schedule_text_en')->rows(4),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                Textarea::make('schedule_text_fr')->rows(4),
                            ]),
                        ]),
                    ]),

                /* ===== AVISO LEGAL / PRIVACIDAD ===== */
                Section::make('Aviso legal / Privacidad (bajo el formulario)')
                    ->schema([
                        Tabs::make('legal_tabs')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                Textarea::make('legal_info_text_es')->rows(5),
                                TextInput::make('checkbox_1_label_es')->label('Checkbox 1 (ES)'),
                                TextInput::make('checkbox_2_label_es')->label('Checkbox 2 (ES)'),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                Textarea::make('legal_info_text_en')->rows(5),
                                TextInput::make('checkbox_1_label_en')->label('Checkbox 1 (EN)'),
                                TextInput::make('checkbox_2_label_en')->label('Checkbox 2 (EN)'),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                Textarea::make('legal_info_text_fr')->rows(5),
                                TextInput::make('checkbox_1_label_fr')->label('Checkbox 1 (FR)'),
                                TextInput::make('checkbox_2_label_fr')->label('Checkbox 2 (FR)'),
                            ]),
                        ]),
                    ]),

                /* ===== CTA FINAL ===== */
                Section::make('CTA – ¿Necesitas ayuda con tu proyecto?')
                    ->schema([
                        Tabs::make('cta_tabs')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                TextInput::make('cta_title_es')->label('Título (ES)'),
                                Textarea::make('cta_text_es')->label('Texto (ES)')->rows(3),
                                TextInput::make('cta_button_text_es')->label('Texto botón (ES)')->placeholder('Contactar'),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                TextInput::make('cta_title_en')->label('Title (EN)'),
                                Textarea::make('cta_text_en')->label('Text (EN)')->rows(3),
                                TextInput::make('cta_button_text_en')->label('Button text (EN)'),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                TextInput::make('cta_title_fr')->label('Titre (FR)'),
                                Textarea::make('cta_text_fr')->label('Texte (FR)')->rows(3),
                                TextInput::make('cta_button_text_fr')->label('Texte du bouton (FR)'),
                            ]),
                        ]),
                        Grid::make(4)->schema([
                            TextInput::make('cta_button_url')->label('URL botón')->url()->columnSpan(2),
                            TextInput::make('cta_bg_image')->label('Imagen BG (URL)')->url()->columnSpan(2),
                            TextInput::make('cta_bg_image_title')->label('BG image title')->columnSpan(2),
                            TextInput::make('cta_bg_image_alt')->label('BG image alt')->columnSpan(2),
                        ]),
                    ]),

                /* ===== REDES ===== */
                Section::make('Redes sociales (footer)')
                    ->schema([
                        Grid::make(4)->schema([
                            TextInput::make('social_linkedin')->label('LinkedIn')->url(),
                            TextInput::make('social_facebook')->label('Facebook')->url(),
                            TextInput::make('social_instagram')->label('Instagram')->url(),
                            TextInput::make('social_youtube')->label('YouTube')->url(),
                        ]),
                    ]),
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
        $this->notify('success', 'Contenido de Contacto actualizado.');
    }
}
