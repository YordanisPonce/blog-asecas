<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\BlogPage as BlogPageModel;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Tabs;
use Filament\Notifications\Notification;
use App\Filament\Components\SeoFields;

class BlogPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Contenido web';
    protected static ?int $navigationSort = 55;
    protected static ?string $navigationLabel = 'SEO - Blog';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $title = 'SEO - Página Blog';
    protected static string $view = 'filament.pages.blog-page';

    public BlogPageModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = BlogPageModel::first() ?? BlogPageModel::create([]);
        $this->form->fill([
            ...$this->record->toArray(),
            'seo' => $this->record->seo?->toArray() ?? [],
        ]);
    }

    protected function getFormModel(): BlogPageModel
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