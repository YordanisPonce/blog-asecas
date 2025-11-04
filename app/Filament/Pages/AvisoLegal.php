<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\LegalPage as LegalModel;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;

class AvisoLegal extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Legal';
    protected static ?int $navigationSort = 10;
    protected static ?string $navigationIcon = 'heroicon-o-scale';
    protected static ?string $title = 'Contenido – Aviso Legal';
    protected static string $view = 'filament.pages.aviso-legal';

    public LegalModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = LegalModel::first() ?? LegalModel::create([]);
        $this->form->fill($this->record->toArray());
    }

    protected function getFormModel(): LegalModel
    {
        return $this->record;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Título de la página')
                    ->schema([
                        Tabs::make('page_titles')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                TextInput::make('page_title_es')->label('Título (ES)')
                                    ->placeholder('Aviso Legal'),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                TextInput::make('page_title_en')->label('Title (EN)')
                                    ->placeholder('Legal Notice'),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                TextInput::make('page_title_fr')->label('Titre (FR)')
                                    ->placeholder('Mentions légales'),
                            ]),
                        ]),
                        Grid::make(3)->schema([
                            DatePicker::make('last_updated_at')->label('Última actualización')->native(false),
                        ]),
                    ])->columns(1),

                Section::make('Identifying Information')
                    ->schema([
                        Tabs::make('ident_info')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                Textarea::make('ident_info_es')->rows(7),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                Textarea::make('ident_info_en')->rows(7),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                Textarea::make('ident_info_fr')->rows(7),
                            ]),
                        ]),
                    ]),

                Section::make('Intellectual Property Rights')
                    ->schema([
                        Tabs::make('ip_rights')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                Textarea::make('ip_rights_es')->rows(7),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                Textarea::make('ip_rights_en')->rows(7),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                Textarea::make('ip_rights_fr')->rows(7),
                            ]),
                        ]),
                    ]),

                Section::make('General Terms of Use')
                    ->schema([
                        Tabs::make('terms_use')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                Textarea::make('terms_use_es')->rows(7),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                Textarea::make('terms_use_en')->rows(7),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                Textarea::make('terms_use_fr')->rows(7),
                            ]),
                        ]),
                    ]),

                Section::make('Exclusion of Warranties and Liability')
                    ->schema([
                        Tabs::make('warranty_exclusion')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                Textarea::make('warranty_exclusion_es')->rows(7),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                Textarea::make('warranty_exclusion_en')->rows(7),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                Textarea::make('warranty_exclusion_fr')->rows(7),
                            ]),
                        ]),
                    ]),

                Section::make('Security Measures')
                    ->schema([
                        Tabs::make('security_measures')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                Textarea::make('security_measures_es')->rows(7),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                Textarea::make('security_measures_en')->rows(7),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                Textarea::make('security_measures_fr')->rows(7),
                            ]),
                        ]),
                    ]),

                Section::make('Modifications')
                    ->schema([
                        Tabs::make('modifications')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                Textarea::make('modifications_es')->rows(5),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                Textarea::make('modifications_en')->rows(5),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                Textarea::make('modifications_fr')->rows(5),
                            ]),
                        ]),
                    ]),

                Section::make('Applicable Law and Jurisdiction')
                    ->schema([
                        Tabs::make('applicable_law')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                Textarea::make('applicable_law_es')->rows(5),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                Textarea::make('applicable_law_en')->rows(5),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                Textarea::make('applicable_law_fr')->rows(5),
                            ]),
                        ]),
                    ]),

                Section::make('SEO (opcional)')
                    ->schema([
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
        $data = $this->form->getState();
        $this->record->fill($data);
        $this->record->save();
        $this->notify('success', 'Contenido del Aviso Legal actualizado.');
    }
}
