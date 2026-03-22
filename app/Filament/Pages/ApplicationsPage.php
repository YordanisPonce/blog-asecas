<?php
// app/Filament/Pages/ApplicationsPage.php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\ApplicationsPage as ApplicationsPageModel;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Notifications\Notification;
use App\Filament\Components\SeoFields;

class ApplicationsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Contenido web';
    protected static ?int $navigationSort = 45;
    protected static ?string $navigationLabel = 'SEO - Aplicaciones';
    protected static ?string $navigationIcon = 'heroicon-o-queue-list';
    protected static ?string $title = 'SEO - Página Aplicaciones';
    protected static string $view = 'filament.pages.applications-page';

    public ApplicationsPageModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = ApplicationsPageModel::first() ?? ApplicationsPageModel::create([]);

        // Cargar datos del modelo + SEO
        $this->form->fill([
            ...$this->record->toArray(),
            'seo' => $this->record->seo?->toArray() ?? [],
        ]);
    }

    protected function getFormModel(): ApplicationsPageModel
    {
        return $this->record;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('SEO')
                    ->tabs([
                        SeoFields::make(),
                    ])
                    ->persistTabInQueryString(),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Guardar SEO')
                ->submit('save')
                ->color('primary'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // 👇 IMPORTANTE: Separar los datos SEO del resto
        $seoData = $data['seo'] ?? [];
        unset($data['seo']); // Eliminar seo del array de datos principales

        // Guardar contenido principal (solo los campos que tiene la tabla)
        $this->record->fill($data);
        $this->record->save();

        // Guardar datos SEO usando el método syncSeo del trait
        if (!empty($seoData)) {
            $this->record->syncSeo($seoData);
        }

        Notification::make()
            ->title('SEO guardado satisfactoriamente')
            ->success()
            ->send();
    }
}
