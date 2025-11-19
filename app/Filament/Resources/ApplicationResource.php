<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Pages;
use App\Models\Application;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Productos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información Básica')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'edit')
                                    return;
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
                                if ($operation === 'edit')
                                    return;
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
                                if ($operation === 'edit')
                                    return;
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

                Forms\Components\Section::make('Medios')
                    ->schema([
                        Forms\Components\FileUpload::make('icon')
                            ->label('Icono')
                            ->image()
                            ->directory('applications/icons')
                            ->preserveFilenames()
                            ->maxSize(1024),

                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen Principal')
                            ->image()
                            ->directory('applications')
                            ->preserveFilenames()
                            ->maxSize(2048),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Fieldset::make('Texto Alternativo (SEO)')
                                    ->schema([
                                        Forms\Components\TextInput::make('image_alt.en')
                                            ->label('Inglés')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('image_alt.es')
                                            ->label('Español')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('image_alt.fr')
                                            ->label('Francés')
                                            ->maxLength(255),
                                    ]),

                                Forms\Components\Fieldset::make('Texto del Título')
                                    ->schema([
                                        Forms\Components\TextInput::make('image_title.en')
                                            ->label('Inglés')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('image_title.es')
                                            ->label('Español')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('image_title.fr')
                                            ->label('Francés')
                                            ->maxLength(255),
                                    ]),
                            ]),
                    ]),

                Forms\Components\Section::make('Categorías Asociadas')
                    ->schema([
                        Forms\Components\Select::make('categories')
                            ->label('Categorías')
                            ->relationship('categories', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->options(Category::active()->ordered()->pluck('name', 'id')),
                    ]),

                Forms\Components\Section::make('Descripciones Cortas')
                    ->schema([
                        Forms\Components\Textarea::make('short_description_en')
                            ->label('Descripción Corta (Inglés)')
                            ->rows(3),
                        Forms\Components\Textarea::make('short_description_es')
                            ->label('Descripción Corta (Español)')
                            ->rows(3),
                        Forms\Components\Textarea::make('short_description_fr')
                            ->label('Descripción Corta (Francés)')
                            ->rows(3),
                    ]),

                Forms\Components\Section::make('Descripciones Completas')
                    ->schema([
                        Forms\Components\RichEditor::make('description_en')
                            ->label('Descripción Completa (Inglés)')
                            ->fileAttachmentsDirectory('applications/descriptions'),
                        Forms\Components\RichEditor::make('description_es')
                            ->label('Descripción Completa (Español)')
                            ->fileAttachmentsDirectory('applications/descriptions'),
                        Forms\Components\RichEditor::make('description_fr')
                            ->label('Descripción Completa (Francés)')
                            ->fileAttachmentsDirectory('applications/descriptions'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('icon')
                    ->label('Icono')
                    ->circular(),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagen')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('categories.name')
                    ->label('Categorías')
                    ->badge()
                    ->separator(','),

                Tables\Columns\TextColumn::make('order')
                    ->label('Orden')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('is_active')
                    ->label('Solo Activos')
                    ->query(fn($query) => $query->where('is_active', true)),

                Tables\Filters\SelectFilter::make('categories')
                    ->label('Categorías')
                    ->relationship('categories', 'name')
                    ->multiple()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Editar'),
                Tables\Actions\DeleteAction::make()
                    ->label('Eliminar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Eliminar Seleccionados'),
                ])->label('Acciones en Lote'),
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Aplicación';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Aplicaciones';
    }

    public static function getNavigationLabel(): string
    {
        return 'Aplicaciones';
    }
}