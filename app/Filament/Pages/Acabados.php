<?php
// app/Filament/Pages/Acabados.php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\FinishesPage as FinishesModel;
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
use Filament\Notifications\Notification;

class Acabados extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';
    protected static ?string $navigationLabel = 'Acabados';
    protected static ?string $title = 'Contenido – Acabados';
    protected static ?string $navigationGroup = 'Contenido web';
    protected static ?int $navigationSort = 75;
    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.pages.acabados';

    public FinishesModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = FinishesModel::first() ?? FinishesModel::create([]);
        $this->form->fill($this->record->toArray());
    }

    protected function getFormModel(): FinishesModel
    {
        return $this->record;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Título de la página')->schema([
                    Tabs::make('titles')->tabs([
                        Tabs\Tab::make('ES')->schema([
                            TextInput::make('page_title_es')->label('Título (ES)')->placeholder('Acabados')->maxLength(140),
                        ]),
                        Tabs\Tab::make('EN')->schema([
                            TextInput::make('page_title_en')->label('Título (EN)')->placeholder('Finishes')->maxLength(140),
                        ]),
                        Tabs\Tab::make('FR')->schema([
                            TextInput::make('page_title_fr')->label('Título (FR)')->placeholder('Finitions')->maxLength(140),
                        ]),
                    ]),
                ])->columns(1),

                Section::make('Introducción (opcional)')->schema([
                    Tabs::make('intro')->tabs([
                        Tabs\Tab::make('ES')->schema([Textarea::make('intro_es')->rows(3)->label('Introducción (ES)')]),
                        Tabs\Tab::make('EN')->schema([Textarea::make('intro_en')->rows(3)->label('Introducción (EN)')]),
                        Tabs\Tab::make('FR')->schema([Textarea::make('intro_fr')->rows(3)->label('Introducción (FR)')]),
                    ]),
                ]),

                Section::make('Lista de acabados')->schema([
                    Repeater::make('finishes_items')
                        ->label('Acabados')
                        ->collapsed()
                        ->addActionLabel('Agregar acabado')
                        ->schema([
                            Grid::make(4)->schema([
                                TextInput::make('slug')->label('Slug')->maxLength(120),
                                TextInput::make('image_url')->label('Imagen (URL)')->url()->columnSpan(2),
                                TextInput::make('image_title')->label('Imagen title'),
                                TextInput::make('image_alt')->label('Imagen alt'),
                            ]),

                            Tabs::make('titles_per_item')->tabs([
                                Tabs\Tab::make('ES')->schema([
                                    TextInput::make('title_es')->label('Título (ES)')->required(),
                                    Textarea::make('description_es')->label('Descripción (ES)')->rows(4)->required(),
                                ]),
                                Tabs\Tab::make('EN')->schema([
                                    TextInput::make('title_en')->label('Título (EN)')->required(),
                                    Textarea::make('description_en')->label('Descripción (EN)')->rows(4)->required(),
                                ]),
                                Tabs\Tab::make('FR')->schema([
                                    TextInput::make('title_fr')->label('Título (FR)')->required(),
                                    Textarea::make('description_fr')->label('Descripción (FR)')->rows(4)->required(),
                                ]),
                            ]),

                            Repeater::make('badges')
                                ->label('Iconos / etiquetas relacionadas')
                                ->collapsed()
                                ->addActionLabel('Agregar icono/etiqueta')
                                ->schema([
                                    Grid::make(3)->schema([
                                        TextInput::make('icon_url')->label('Icono (URL)')->url()->required(),
                                        TextInput::make('icon_title')->label('Icon title'),
                                        TextInput::make('icon_alt')->label('Icon alt'),
                                    ]),
                                    Grid::make(3)->schema([
                                        TextInput::make('label_es')->label('Etiqueta (ES)'),
                                        TextInput::make('label_en')->label('Etiqueta (EN)'),
                                        TextInput::make('label_fr')->label('Etiqueta (FR)'),
                                    ]),
                                ]),
                        ]),
                ])->columns(1),

                Section::make('SEO (opcional)')->schema([
                    Tabs::make('seo')->tabs([
                        Tabs\Tab::make('ES')->schema([
                            TextInput::make('seo_title_es')->label('SEO title (ES)')->maxLength(70),
                            TextInput::make('seo_description_es')->label('SEO description (ES)')->maxLength(300),
                        ]),
                        Tabs\Tab::make('EN')->schema([
                            TextInput::make('seo_title_en')->label('SEO title (EN)')->maxLength(70),
                            TextInput::make('seo_description_en')->label('SEO description (EN)')->maxLength(300),
                        ]),
                        Tabs\Tab::make('FR')->schema([
                            TextInput::make('seo_title_fr')->label('SEO title (FR)')->maxLength(70),
                            TextInput::make('seo_description_fr')->label('SEO description (FR)')->maxLength(300),
                        ]),
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
        $this->record->fill($this->form->getState());
        $this->record->save();

        Notification::make()
            ->title('Cambios guardados satisfactoriamente')
            ->success()
            ->send();
    }
}
