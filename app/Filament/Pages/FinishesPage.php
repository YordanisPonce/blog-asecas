<?php
// app/Filament/Pages/FinishesPage.php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\FinishesPage as FinishesModel;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Notifications\Notification;
use App\Filament\Components\SeoFields;

class FinishesPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Contenido web';
    protected static ?int $navigationSort = 76;
    protected static ?string $navigationLabel = 'SEO - Acabados';
    protected static ?string $navigationIcon = 'heroicon-o-swatch';
    protected static ?string $title = 'SEO - Página Acabados';
    protected static string $view = 'filament.pages.finishes-page';

    public FinishesModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = FinishesModel::first() ?? FinishesModel::create([]);

        $this->form->fill([
            ...$this->record->toArray(),
            'seo' => $this->record->seo?->toArray() ?? [],
        ]);
    }

    protected function getFormModel(): FinishesModel
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

        $seoData = $data['seo'] ?? [];
        unset($data['seo']);

        $this->record->fill($data);
        $this->record->save();

        if (!empty($seoData)) {
            $this->record->syncSeo($seoData);
        }

        Notification::make()
            ->title('SEO guardado satisfactoriamente')
            ->success()
            ->send();
    }
}
