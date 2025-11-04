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

class Home extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationLabel = 'Home';
    protected static ?string $title = 'Contenido de la Home';
    protected static ?string $navigationGroup = 'Contenido';
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

    public function form(Form $form): Form
    {
        return $form
            // ->model($this->record) // alternativo a getFormModel(); cualquiera de los dos
            ->schema([
                Section::make('Hero / Primer bloque')
                    ->description('Textos principales e info de la primera imagen.')
                    ->schema([
                        Grid::make(3)->schema([
                            Textarea::make('first_description_es')->label('Descripción (ES)')->rows(3),
                            Textarea::make('first_description_en')->label('Descripción (EN)')->rows(3),
                            Textarea::make('first_description_fr')->label('Descripción (FR)')->rows(3),
                        ]),
                        Grid::make(3)->schema([
                            TextInput::make('first_image_title_es')->label('Imagen: title (ES)'),
                            TextInput::make('first_image_title_en')->label('Imagen: title (EN)'),
                            TextInput::make('first_image_title_fr')->label('Imagen: title (FR)'),
                        ]),
                        Grid::make(3)->schema([
                            TextInput::make('first_image_alt_es')->label('Imagen: alt (ES)'),
                            TextInput::make('first_image_alt_en')->label('Imagen: alt (EN)'),
                            TextInput::make('first_image_alt_fr')->label('Imagen: alt (FR)'),
                        ]),
                    ])->columns(1),

                Section::make('Segundo bloque')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('sencond_title_es')->label('Título (ES)'),
                            TextInput::make('sencond_title_en')->label('Título (EN)'),
                            TextInput::make('sencond_title_fr')->label('Título (FR)'),
                        ]),
                        Grid::make(3)->schema([
                            Textarea::make('sencond_description_es')->label('Descripción (ES)')->rows(3),
                            Textarea::make('sencond_description_en')->label('Descripción (EN)')->rows(3),
                            Textarea::make('sencond_description_fr')->label('Descripción (FR)')->rows(3),
                        ]),
                        Grid::make(3)->schema([
                            TextInput::make('second_image_title_es')->label('Imagen: title (ES)'),
                            TextInput::make('second_image_title_en')->label('Imagen: title (EN)'),
                            TextInput::make('second_image_title_fr')->label('Imagen: title (FR)'),
                        ]),
                        Grid::make(3)->schema([
                            TextInput::make('second_image_alt_es')->label('Imagen: alt (ES)'),
                            TextInput::make('second_image_alt_en')->label('Imagen: alt (EN)'),
                            TextInput::make('second_image_alt_fr')->label('Imagen: alt (FR)'),
                        ]),
                    ])->columns(1),

                Section::make('Tercer bloque')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('third_title_es')->label('Título (ES)'),
                            TextInput::make('third_title_en')->label('Título (EN)'),
                            TextInput::make('third_title_fr')->label('Título (FR)'),
                        ]),
                        Grid::make(3)->schema([
                            Textarea::make('third_description_es')->label('Descripción (ES)')->rows(3),
                            Textarea::make('third_description_en')->label('Descripción (EN)')->rows(3),
                            Textarea::make('third_description_fr')->label('Descripción (FR)')->rows(3),
                        ]),
                    ])->columns(1),

                Section::make('Inspiración')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('inspiration_text_es')->label('Texto (ES)'),
                            TextInput::make('inspiration_text_en')->label('Texto (EN)'),
                            TextInput::make('inspiration_text_fr')->label('Texto (FR)'),
                        ]),
                        Grid::make(3)->schema([
                            Repeater::make('inspiration_images_es')
                                ->label('Imágenes (ES)')
                                ->schema([
                                    TextInput::make('url')->label('URL')->url()->required(),
                                    TextInput::make('alt')->label('Alt'),
                                ])->collapsed()->addActionLabel('Agregar imagen')->columnSpan(1),

                            Repeater::make('inspiration_images_en')
                                ->label('Imágenes (EN)')
                                ->schema([
                                    TextInput::make('url')->label('URL')->url()->required(),
                                    TextInput::make('alt')->label('Alt'),
                                ])->collapsed()->addActionLabel('Agregar imagen')->columnSpan(1),

                            Repeater::make('inspiration_images_fr')
                                ->label('Imágenes (FR)')
                                ->schema([
                                    TextInput::make('url')->label('URL')->url()->required(),
                                    TextInput::make('alt')->label('Alt'),
                                ])->collapsed()->addActionLabel('Agregar imagen')->columnSpan(1),
                        ])->columnSpanFull(),
                    ])->columns(1),

                Section::make('Blog / CTA final')
                    ->schema([
                        Grid::make(3)->schema([
                            Textarea::make('blog_text_es')->label('Texto (ES)')->rows(2),
                            Textarea::make('blog_text_en')->label('Texto (EN)')->rows(2),
                            Textarea::make('blog_text_fr')->label('Texto (FR)')->rows(2),
                        ]),
                    ])->columns(1),
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

        // Recomendado: fill + save
        $this->record->fill($data);
        $this->record->save();

        $this->notify('success', 'Contenido de la Home actualizado.');
    }
}
