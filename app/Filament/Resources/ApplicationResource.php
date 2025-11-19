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
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'edit')
                                    return;
                                $set('slug', Str::slug($state));
                            }),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('name_en')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'edit')
                                    return;
                                $set('slug_en', Str::slug($state));
                            }),
                        Forms\Components\TextInput::make('slug_en')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('name_fr')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'edit')
                                    return;
                                $set('slug_fr', Str::slug($state));
                            }),
                        Forms\Components\TextInput::make('slug_fr')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->label('Activo'),
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
                            ->label('Imagen principal')
                            ->image()
                            ->directory('applications')
                            ->preserveFilenames()
                            ->maxSize(2048),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Fieldset::make('Alt Text (SEO)')
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

                                Forms\Components\Fieldset::make('Title Text')
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
                            ->relationship('categories', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->options(Category::active()->ordered()->pluck('name', 'id'))
                            ->label('Seleccionar Categorías'),
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
                    ->label('Creado')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('is_active')
                    ->label('Solo activos')
                    ->query(fn($query) => $query->where('is_active', true)),

                Tables\Filters\SelectFilter::make('categories')
                    ->relationship('categories', 'name')
                    ->multiple()
                    ->preload()
                    ->label('Filtrar por Categoría'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
}