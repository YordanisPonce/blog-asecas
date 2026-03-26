<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $navigationGroup = 'Catálogo';
    protected static ?int $navigationSort = 20;
    protected static ?string $navigationLabel = 'Categorías';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


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
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen de la Categoría')
                            ->image()
                            ->disk('public')
                            ->directory('img') // Es mejor usar subdirectorio específico
                            ->preserveFilenames()
                            ->maxSize(2048) // 2MB
                            ->imagePreviewHeight(250)
                            ->downloadable()
                            ->openable()
                            ->deletable(true)
                            ->helperText('Formatos: JPG, PNG, WebP. Máximo 2MB')
                            ->rules(['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048']),

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

                Forms\Components\Section::make('Descripciones Completas')
                    ->schema([
                        Forms\Components\Textarea::make('description_en')
                            ->label('Descripción Completa (Inglés)')
                            ->rows(6),

                        Forms\Components\Textarea::make('description_es')
                            ->label('Descripción Completa (Español)')
                            ->rows(6),

                        Forms\Components\Textarea::make('description_fr')
                            ->label('Descripción Completa (Francés)')
                            ->rows(6),
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


                Forms\Components\Section::make('Optimización SEO')
                    ->icon('heroicon-o-globe-alt')
                    ->schema([
                        Forms\Components\Tabs::make('SEO Tabs')
                            ->tabs([
                                Forms\Components\Tabs\Tab::make('Español')
                                    ->schema([
                                        Forms\Components\TextInput::make('meta_title_es')
                                            ->label('Meta Title (ES)')
                                            ->maxLength(60),
                                        Forms\Components\Textarea::make('meta_description_es')
                                            ->label('Meta Description (ES)')
                                            ->maxLength(160)
                                            ->rows(2),
                                        Forms\Components\Textarea::make('meta_keywords_es')
                                            ->label('Meta Keywords (ES)')
                                            ->helperText('Separadas por comas'),
                                        Forms\Components\TextInput::make('og_title_es')
                                            ->label('OG Title (ES)'),
                                        Forms\Components\Textarea::make('og_description_es')
                                            ->label('OG Description (ES)')
                                            ->rows(2),
                                    ]),
                                Forms\Components\Tabs\Tab::make('English')
                                    ->schema([
                                        Forms\Components\TextInput::make('meta_title_en')
                                            ->label('Meta Title (EN)')
                                            ->maxLength(60),
                                        Forms\Components\Textarea::make('meta_description_en')
                                            ->label('Meta Description (EN)')
                                            ->maxLength(160)
                                            ->rows(2),
                                        Forms\Components\Textarea::make('meta_keywords_en')
                                            ->label('Meta Keywords (EN)'),
                                        Forms\Components\TextInput::make('og_title_en')
                                            ->label('OG Title (EN)'),
                                        Forms\Components\Textarea::make('og_description_en')
                                            ->label('OG Description (EN)')
                                            ->rows(2),
                                    ]),
                                Forms\Components\Tabs\Tab::make('Français')
                                    ->schema([
                                        Forms\Components\TextInput::make('meta_title_fr')
                                            ->label('Meta Title (FR)')
                                            ->maxLength(60),
                                        Forms\Components\Textarea::make('meta_description_fr')
                                            ->label('Meta Description (FR)')
                                            ->maxLength(160)
                                            ->rows(2),
                                        Forms\Components\Textarea::make('meta_keywords_fr')
                                            ->label('Meta Keywords (FR)'),
                                        Forms\Components\TextInput::make('og_title_fr')
                                            ->label('OG Title (FR)'),
                                        Forms\Components\Textarea::make('og_description_fr')
                                            ->label('OG Description (FR)')
                                            ->rows(2),
                                    ]),
                            ]),

                        Forms\Components\FileUpload::make('og_image')
                            ->label('OG Image (Imagen para redes sociales)')
                            ->image()
                            ->disk('public')
                            ->directory('seo/og-images')
                            ->visibility('public')
                            ->helperText('Recomendado: 1200x630px'),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagen')
                    ->disk('public')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),

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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Categoría';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Categorías';
    }

    public static function getNavigationLabel(): string
    {
        return 'Categorías';
    }
}
