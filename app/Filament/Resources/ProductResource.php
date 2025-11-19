<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\DocumentsRelationManager;
use App\Models\Product;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Productos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información Básica')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Categoría'),

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

                        Forms\Components\TextInput::make('subtitle')
                            ->label('Subtítulo')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('order')
                            ->label('Orden')
                            ->numeric()
                            ->default(0),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Activo')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('Imagen del Producto')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen Principal')
                            ->image()
                            ->directory('products')
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

                Forms\Components\Section::make('Especificaciones')
                    ->schema([
                        Forms\Components\TextInput::make('presentation')
                            ->label('Presentación')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('pallet_info')
                            ->label('Información de Palet')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('storage_info')
                            ->label('Información de Almacenamiento')
                            ->maxLength(255),
                    ])->columns(1),

                Forms\Components\Section::make('Composición')
                    ->schema([
                        Forms\Components\RichEditor::make('composition_en')
                            ->label('Composición (Inglés)')
                            ->fileAttachmentsDirectory('products/composition'),
                        Forms\Components\RichEditor::make('composition_es')
                            ->label('Composición (Español)')
                            ->fileAttachmentsDirectory('products/composition'),
                        Forms\Components\RichEditor::make('composition_fr')
                            ->label('Composición (Francés)')
                            ->fileAttachmentsDirectory('products/composition'),
                    ])->columns(1),

                Forms\Components\Section::make('Características')
                    ->description('Usa guiones (-) para crear listas')
                    ->schema([
                        Forms\Components\Textarea::make('features_en')
                            ->label('Características (Inglés)')
                            ->rows(5),
                        Forms\Components\Textarea::make('features_es')
                            ->label('Características (Español)')
                            ->rows(5),
                        Forms\Components\Textarea::make('features_fr')
                            ->label('Características (Francés)')
                            ->rows(5),
                    ])->columns(1),

                Forms\Components\Section::make('Recomendaciones')
                    ->schema([
                        Forms\Components\RichEditor::make('recommendations_en')
                            ->label('Recomendaciones (Inglés)')
                            ->fileAttachmentsDirectory('products/recommendations'),
                        Forms\Components\RichEditor::make('recommendations_es')
                            ->label('Recomendaciones (Español)')
                            ->fileAttachmentsDirectory('products/recommendations'),
                        Forms\Components\RichEditor::make('recommendations_fr')
                            ->label('Recomendaciones (Francés)')
                            ->fileAttachmentsDirectory('products/recommendations'),
                    ])->columns(1),

                Forms\Components\Section::make('Portadores')
                    ->schema([
                        Forms\Components\RichEditor::make('carriers_en')
                            ->label('Portadores (Inglés)')
                            ->fileAttachmentsDirectory('products/carriers'),
                        Forms\Components\RichEditor::make('carriers_es')
                            ->label('Portadores (Español)')
                            ->fileAttachmentsDirectory('products/carriers'),
                        Forms\Components\RichEditor::make('carriers_fr')
                            ->label('Portadores (Francés)')
                            ->fileAttachmentsDirectory('products/carriers'),
                    ])->columns(1),

                Forms\Components\Section::make('Información Relevante')
                    ->schema([
                        Forms\Components\RichEditor::make('relevant_info_en')
                            ->label('Información Relevante (Inglés)')
                            ->fileAttachmentsDirectory('products/relevant-info'),
                        Forms\Components\RichEditor::make('relevant_info_es')
                            ->label('Información Relevante (Español)')
                            ->fileAttachmentsDirectory('products/relevant-info'),
                        Forms\Components\RichEditor::make('relevant_info_fr')
                            ->label('Información Relevante (Francés)')
                            ->fileAttachmentsDirectory('products/relevant-info'),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagen')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtítulo')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoría')
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Orden')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),

                Tables\Columns\TextColumn::make('documents_count')
                    ->label('Documentos')
                    ->counts('documents')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('is_active')
                    ->label('Solo Activos')
                    ->query(fn($query) => $query->where('is_active', true)),

                Tables\Filters\SelectFilter::make('category')
                    ->label('Categoría')
                    ->relationship('category', 'name')
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
            DocumentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Producto';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Productos';
    }

    public static function getNavigationLabel(): string
    {
        return 'Productos';
    }
}