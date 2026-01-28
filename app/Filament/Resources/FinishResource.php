<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FinishResource\Pages;
use App\Filament\Resources\FinishResource\RelationManagers\CategoriesRelationManager;
use App\Models\Finish;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class FinishResource extends Resource
{
    protected static ?string $model = Finish::class;

    protected static ?string $navigationGroup = 'Catálogo';
    protected static ?string $navigationIcon = 'heroicon-o-swatch';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Información Básica')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nombre')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                            if ($operation === 'edit') return;
                            $set('slug', Str::slug($state));
                        }),

                    Forms\Components\TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('name_en')
                        ->label('Nombre (Inglés)')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                            if ($operation === 'edit') return;
                            $set('slug_en', Str::slug($state));
                        }),

                    Forms\Components\TextInput::make('slug_en')
                        ->label('Slug (Inglés)')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('name_fr')
                        ->label('Nombre (Francés)')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                            if ($operation === 'edit') return;
                            $set('slug_fr', Str::slug($state));
                        }),

                    Forms\Components\TextInput::make('slug_fr')
                        ->label('Slug (Francés)')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('order')
                        ->label('Orden')
                        ->numeric()
                        ->default(0),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Activo')
                        ->default(true),
                ])->columns(2),

            Forms\Components\Section::make('Imagen')
                ->schema([
                    // Puedes cambiarlo a TextInput si tú quieres URL,
                    // pero FileUpload queda igual que Product.
                    Forms\Components\FileUpload::make('image')
                        ->label('Imagen del acabado')
                        ->image()
                        ->preserveFilenames()
                        ->directory('finishes')
                        ->maxSize(2048),

                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\Fieldset::make('Texto Alternativo (SEO)')
                            ->schema([
                                Forms\Components\TextInput::make('image_alt.en')->label('Inglés'),
                                Forms\Components\TextInput::make('image_alt.es')->label('Español'),
                                Forms\Components\TextInput::make('image_alt.fr')->label('Francés'),
                            ]),
                        Forms\Components\Fieldset::make('Texto del Título')
                            ->schema([
                                Forms\Components\TextInput::make('image_title.en')->label('Inglés'),
                                Forms\Components\TextInput::make('image_title.es')->label('Español'),
                                Forms\Components\TextInput::make('image_title.fr')->label('Francés'),
                            ]),
                    ]),
                ]),

            Forms\Components\Section::make('Descripciones Completas')
                ->schema([
                    Forms\Components\RichEditor::make('description_es')->label('Descripción (ES)')
                        ->fileAttachmentsDirectory('finishes/descriptions'),
                    Forms\Components\RichEditor::make('description_en')->label('Descripción (EN)')
                        ->fileAttachmentsDirectory('finishes/descriptions'),
                    Forms\Components\RichEditor::make('description_fr')->label('Descripción (FR)')
                        ->fileAttachmentsDirectory('finishes/descriptions'),
                ]),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image')->label('Imagen')->circular(),
            Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('slug')->label('Slug')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('order')->label('Orden')->sortable(),
            Tables\Columns\IconColumn::make('is_active')->label('Activo')->boolean(),
            Tables\Columns\TextColumn::make('created_at')->label('Creado')->dateTime()->sortable(),
        ])
            ->filters([
                Tables\Filters\Filter::make('is_active')
                    ->label('Solo Activos')
                    ->query(fn($query) => $query->where('is_active', true)),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar'),
                Tables\Actions\DeleteAction::make()->label('Eliminar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Eliminar Seleccionados'),
                ])->label('Acciones en Lote'),
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            CategoriesRelationManager::class, // 👈 lo hacemos ahora
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFinishes::route('/'),
            'create' => Pages\CreateFinish::route('/create'),
            'edit' => Pages\EditFinish::route('/{record}/edit'),
        ];
    }
}
