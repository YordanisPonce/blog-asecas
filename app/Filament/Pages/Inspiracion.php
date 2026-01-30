<?php

namespace App\Filament\Pages;

use App\Models\InspirationPage as InspirationPageModel;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Inspiracion extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationLabel = 'Página Inspiración';
    protected static ?string $title = 'Contenido – Inspiración';
    protected static ?string $navigationGroup = 'Contenido web';
    protected static ?int $navigationSort = 60;

    protected static string $view = 'filament.pages.inspiracion';

    public InspirationPageModel $record;

    /**
     * OJO: como usamos statePath('data'), aquí vive el estado del form.
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = InspirationPageModel::first() ?? InspirationPageModel::create([]);

        // Llenar el form con valores del record
        $this->form->fill($this->record->toArray());
    }

    protected function getFormModel(): InspirationPageModel
    {
        return $this->record;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Título')->schema([
                    Tabs::make('titles')->tabs([
                        Tabs\Tab::make('ES')->schema([
                            TextInput::make('title_es')->label('Título (ES)')->required(),
                        ]),
                        Tabs\Tab::make('EN')->schema([
                            TextInput::make('title_en')->label('Title (EN)'),
                        ]),
                        Tabs\Tab::make('FR')->schema([
                            TextInput::make('title_fr')->label('Titre (FR)'),
                        ]),
                    ]),
                ]),

                Section::make('Descripción (opcional)')->schema([
                    Tabs::make('descriptions')->tabs([
                        Tabs\Tab::make('ES')->schema([
                            Textarea::make('description_es')->label('Descripción (ES)')->rows(4),
                        ]),
                        Tabs\Tab::make('EN')->schema([
                            Textarea::make('description_en')->label('Description (EN)')->rows(4),
                        ]),
                        Tabs\Tab::make('FR')->schema([
                            Textarea::make('description_fr')->label('Description (FR)')->rows(4),
                        ]),
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

                Section::make('Control de imágenes')->schema([
                    TextInput::make('default_limit')
                        ->label('Límite sugerido para secciones pequeñas')
                        ->helperText("Define cuántas imágenes se verán en secciones pequeñas (como la Home). Ej: 8 = se ven 8. En la página de Inspiración normalmente se ven todas. 0 = sin límite (se ven todas).")

                        ->numeric()
                        ->minValue(0)
                        ->default(0),
                ]),
            ])
            ->statePath('data'); // <-- el estado vive en $this->data
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
        // Validación del form (Filament valida automáticamente, pero lo forzamos si quieres)
        $this->form->validate();

        // Como statePath('data'), el estado está en $this->data
        $this->record->fill($this->data);
        $this->record->save();

        Notification::make()
            ->title('Contenido de Inspiración actualizado.')
            ->success()
            ->send();
    }
}
