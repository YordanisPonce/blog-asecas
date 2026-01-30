<?php

namespace App\Filament\Pages;

use App\Models\WorkWithUsPage as WorkModel;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class TrabajaConNosotros extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Sitio';
    protected static ?int $navigationSort = 31;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $title = 'Contenido – Trabaja con nosotros';
    protected static string $view = 'filament.pages.trabaja-con-nosotros';

    public WorkModel $record;
    public ?array $data = [];

    public function mount(): void
    {
        $this->record = WorkModel::firstOrCreate(['id' => 1]);
        $this->form->fill($this->record->toArray());
    }

    protected function getFormModel(): WorkModel
    {
        return $this->record;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Hero (imagen + título superior)')
                    ->schema([
                        Tabs::make('hero_tabs')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                TextInput::make('hero_title_es')->label('Título Hero (ES)'),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                TextInput::make('hero_title_en')->label('Hero title (EN)'),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                TextInput::make('hero_title_fr')->label('Titre hero (FR)'),
                            ]),
                        ]),
                        FileUpload::make('hero_bg_image')
                            ->label('Imagen de fondo (Hero)')
                            ->disk('public')
                            ->directory('work-with-us')
                        
                            
                            ->maxSize(2048) // 2MB
                            ->imagePreviewHeight(250)
                            ->downloadable()
                            ->openable()
                            ->deletable(true)
                            ->helperText('Formatos: JPG, PNG, WebP. Máximo 2MB')
                            ->rules(['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048']),
                    ]),

                Section::make('Sección (título + descripción)')
                    ->schema([
                        Tabs::make('section_tabs')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                TextInput::make('section_title_es')->label('Título sección (ES)'),
                                Textarea::make('section_text_es')->label('Descripción (ES)')->rows(4),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                TextInput::make('section_title_en')->label('Section title (EN)'),
                                Textarea::make('section_text_en')->label('Description (EN)')->rows(4),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                TextInput::make('section_title_fr')->label('Titre section (FR)'),
                                Textarea::make('section_text_fr')->label('Description (FR)')->rows(4),
                            ]),
                        ]),
                    ]),

                Section::make('Formulario (labels/placeholders + legal + checkboxes)')
                    ->schema([
                        Tabs::make('form_tabs')->tabs([
                            Tabs\Tab::make('ES')->schema([
                                TextInput::make('field_name_label_es')->label('Label Nombre (ES)')->default('Nombre'),
                                TextInput::make('field_phone_label_es')->label('Label Teléfono (ES)')->default('Teléfono'),
                                TextInput::make('field_email_label_es')->label('Label E-mail (ES)')->default('E-mail'),
                                TextInput::make('field_speciality_label_es')->label('Label Especialidad (ES)')->default('Especialidad'),
                                TextInput::make('field_message_label_es')->label('Label Mensaje (ES)')->default('Mensaje'),
                                TextInput::make('cv_label_es')->label('Label Adjuntar CV (ES)')->default('Adjuntar CV'),
                                TextInput::make('submit_text_es')->label('Texto botón enviar (ES)')->default('Enviar'),
                                Textarea::make('legal_info_text_es')->label('Legal (ES)')->rows(6),
                                TextInput::make('checkbox_1_label_es')->label('Checkbox 1 (ES)'),
                                TextInput::make('checkbox_2_label_es')->label('Checkbox 2 (ES)'),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                TextInput::make('field_name_label_en')->label('Name label (EN)')->default('Name'),
                                TextInput::make('field_phone_label_en')->label('Phone label (EN)')->default('Phone'),
                                TextInput::make('field_email_label_en')->label('Email label (EN)')->default('E-mail'),
                                TextInput::make('field_speciality_label_en')->label('Speciality label (EN)')->default('Speciality'),
                                TextInput::make('field_message_label_en')->label('Message label (EN)')->default('Message'),
                                TextInput::make('cv_label_en')->label('Attach CV label (EN)')->default('Attach CV'),
                                TextInput::make('submit_text_en')->label('Submit text (EN)')->default('Send'),
                                Textarea::make('legal_info_text_en')->label('Legal (EN)')->rows(6),
                                TextInput::make('checkbox_1_label_en')->label('Checkbox 1 (EN)'),
                                TextInput::make('checkbox_2_label_en')->label('Checkbox 2 (EN)'),
                            ]),
                            Tabs\Tab::make('FR')->schema([
                                TextInput::make('field_name_label_fr')->label('Nom label (FR)')->default('Nom'),
                                TextInput::make('field_phone_label_fr')->label('Téléphone label (FR)')->default('Téléphone'),
                                TextInput::make('field_email_label_fr')->label('E-mail label (FR)')->default('E-mail'),
                                TextInput::make('field_speciality_label_fr')->label('Spécialité label (FR)')->default('Spécialité'),
                                TextInput::make('field_message_label_fr')->label('Message label (FR)')->default('Message'),
                                TextInput::make('cv_label_fr')->label('Joindre CV label (FR)')->default('Joindre CV'),
                                TextInput::make('submit_text_fr')->label('Submit text (FR)')->default('Envoyer'),
                                Textarea::make('legal_info_text_fr')->label('Legal (FR)')->rows(6),
                                TextInput::make('checkbox_1_label_fr')->label('Checkbox 1 (FR)'),
                                TextInput::make('checkbox_2_label_fr')->label('Checkbox 2 (FR)'),
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
        $this->record->fill($data)->save();

        Notification::make()
            ->title('Cambios guardados satisfactoriamente')
            ->success()
            ->send();
    }
}
