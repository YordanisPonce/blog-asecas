<?php
// app/Filament/Pages/Espacios.php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\SpacesPage as SpacesModel;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class Espacios extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Contenido – Espacios';
    protected static ?string $title = 'Contenido – Espacios';
    protected static ?string $navigationGroup = 'Sitio';
    protected static ?int $navigationSort = 30;
    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.pages.espacios';

    public SpacesModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = SpacesModel::first() ?? SpacesModel::create([]);
        $this->form->fill($this->record->toArray());
    }

    protected function getFormModel(): SpacesModel
    {
        return $this->record;
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Título')->schema([
                Tabs::make('titles')->tabs([
                    Tabs\Tab::make('ES')->schema([
                        TextInput::make('title_es')->label('Título (ES)')->placeholder('Fachadas')->required(),
                    ]),
                    Tabs\Tab::make('EN')->schema([
                        TextInput::make('title_en')->label('Título (EN)')->placeholder('Facades')->required(),
                    ]),
                    Tabs\Tab::make('FR')->schema([
                        TextInput::make('title_fr')->label('Título (FR)')->placeholder('Façades')->required(),
                    ]),
                ]),
            ]),

            Section::make('Descripción')->schema([
                Tabs::make('descriptions')->tabs([
                    Tabs\Tab::make('ES')->schema([
                        Textarea::make('description_es')->label('Descripción (ES)')->rows(6)->required(),
                    ]),
                    Tabs\Tab::make('EN')->schema([
                        Textarea::make('description_en')->label('Descripción (EN)')->rows(6)->required(),
                    ]),
                    Tabs\Tab::make('FR')->schema([
                        Textarea::make('description_fr')->label('Descripción (FR)')->rows(6)->required(),
                    ]),
                ]),
            ]),

            Section::make('Imagen')->schema([
                Grid::make(4)->schema([
                    TextInput::make('image_url')->label('Imagen (URL)')->url()->columnSpan(2),
                    TextInput::make('image_title_es')->label('Imagen title (ES)'),
                    TextInput::make('image_alt_es')->label('Imagen alt (ES)'),
                    TextInput::make('image_title_en')->label('Imagen title (EN)'),
                    TextInput::make('image_alt_en')->label('Imagen alt (EN)'),
                    TextInput::make('image_title_fr')->label('Imagen title (FR)'),
                    TextInput::make('image_alt_fr')->label('Imagen alt (FR)'),
                ]),
            ]),

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
        ])->statePath('data');
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

        $this->notify('success', 'Contenido de Espacios actualizado.');
    }
}
