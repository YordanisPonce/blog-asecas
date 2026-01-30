<?php

namespace App\Filament\Pages;

use App\Models\FooterPage as FooterModel;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;

class Footer extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Contenido web';
    protected static ?int $navigationSort = 90;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Footer';
    protected static ?string $title = 'Contenido – Footer';
    protected static string $view = 'filament.pages.footer';

    public FooterModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = FooterModel::firstOrCreate(['id' => 1]);
        $this->form->fill($this->record->toArray());
    }

    protected function getFormModel(): FooterModel
    {
        return $this->record;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('General')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo (Footer)')
                            ->disk('public')
                            ->directory('footer')
                            ->preserveFilenames()
                            ->image()
                            ->imagePreviewHeight(120)
                            ->downloadable()
                            ->openable()
                            ->deletable(true)
                            ->maxSize(2048)
                            ->helperText('Formatos: JPG, PNG, WebP. Máximo 2MB'),
                    ]),

                Section::make('Contenido (multi-idioma)')
                    ->schema([
                        Tabs::make('footer_tabs')->tabs([
                            Tabs\Tab::make('ES')->schema($this->langSchema('es')),
                            Tabs\Tab::make('EN')->schema($this->langSchema('en')),
                            Tabs\Tab::make('FR')->schema($this->langSchema('fr')),
                        ]),
                    ]),
            ])
            ->statePath('data');
    }

    private function langSchema(string $lang): array
    {
        return [
            TextInput::make("legal_title_{$lang}")->label('Título bloque Legal')->nullable(),
            Repeater::make("legal_links_{$lang}")
                ->label('Links Legal')
                ->schema([
                    Textarea::make('label_html')->label('Label (permite HTML)')->rows(2),
                    TextInput::make('url')->label('URL')->placeholder('/politica-privacidad')->required(),
                ])
                ->reorderable()
                ->collapsible(),

            TextInput::make("company_title_{$lang}")->label('Título bloque Empresa')->nullable(),
            Repeater::make("company_links_{$lang}")
                ->label('Links Empresa')
                ->schema([
                    Textarea::make('label_html')->label('Label (permite HTML)')->rows(2),
                    TextInput::make('url')->label('URL')->required(),
                ])
                ->reorderable()
                ->collapsible(),

            TextInput::make("products_title_{$lang}")->label('Título bloque Productos')->nullable(),
            Repeater::make("products_links_{$lang}")
                ->label('Links Productos')
                ->schema([
                    Textarea::make('label_html')->label('Label (permite HTML)')->rows(2),
                    TextInput::make('url')->label('URL')->required(),
                ])
                ->reorderable()
                ->collapsible(),

            TextInput::make("contact_title_{$lang}")->label('Título bloque Contacto')->nullable(),
            Textarea::make("contact_address_html_{$lang}")
                ->label('Dirección (HTML permitido)')
                ->rows(3)
                ->helperText('Puedes usar <br/> para saltos de línea.'),

            TextInput::make("follow_title_{$lang}")->label('Título bloque Síguenos')->nullable(),
            Repeater::make("social_links_{$lang}")
                ->label('Redes Sociales')
                ->schema([
                    TextInput::make('icon_key')->label('Icon key')->placeholder('linkedin | facebook | instagram | youtube'),
                    Textarea::make('label_html')->label('Label (permite HTML)')->rows(2),
                    TextInput::make('url')->label('URL')->required(),
                ])
                ->reorderable()
                ->collapsible(),

            TextInput::make("copyright_text_{$lang}")
                ->label('Copyright')
                ->placeholder('Copyright©2025')
                ->nullable(),

            Section::make('Contacto (compartido)')
                ->schema([
                    TextInput::make('contact_phone_1')->label('Teléfono 1')->nullable(),
                    TextInput::make('contact_phone_2')->label('Teléfono 2')->nullable(),
                    TextInput::make('contact_email')->label('Email')->email()->nullable(),
                ])
                ->columns(3),
        ];
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
        $this->record->fill($data)->save();

        Notification::make()
            ->title('Footer guardado satisfactoriamente')
            ->success()
            ->send();
    }
}
