<?php
// app/Filament/Resources/ProductCategoryResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCategoryResource\Pages;
use App\Models\ProductCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Categorías de productos';
    protected static ?string $navigationGroup = 'Catálogo';
    protected static ?int $navigationSort = 10;

    protected static bool $shouldRegisterNavigation = false;

    public static function getModelLabel(): string
    {
        return 'categoría de producto';
    }

    public static function getPluralModelLabel(): string
    {
        return 'categorías de productos';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Imagen y estado')->schema([
                Forms\Components\FileUpload::make('image_path')
                    ->label('Imagen')
                    ->image()
                    ->directory('product-categories')
                    ->disk('public')
                    ->visibility('public')
                    ->imageEditor()
                    ->imagePreviewHeight('200')
                    ->downloadable()
                    ->openable()
                    ->reorderable(),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->unique(ignoreRecord: true)
                    ->helperText('Si lo dejas vacío, se genera automáticamente.')
                    ->maxLength(120),

                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\TextInput::make('position')->numeric()->label('Orden')->default(0),
                    Forms\Components\Toggle::make('is_active')->label('Activo')->default(true),
                ]),
            ])->columns(2),

            Forms\Components\Section::make('Título')->schema([
                Forms\Components\Tabs::make('titles')->tabs([
                    Forms\Components\Tabs\Tab::make('ES')->schema([
                        Forms\Components\TextInput::make('title_es')->label('Título (ES)')->required(),
                        Forms\Components\TextInput::make('subdescription_es')->label('Subdescripción (ES)')->maxLength(255),
                    ]),
                    Forms\Components\Tabs\Tab::make('EN')->schema([
                        Forms\Components\TextInput::make('title_en')->label('Título (EN)')->required(),
                        Forms\Components\TextInput::make('subdescription_en')->label('Subdescripción (EN)')->maxLength(255),
                    ]),
                    Forms\Components\Tabs\Tab::make('FR')->schema([
                        Forms\Components\TextInput::make('title_fr')->label('Título (FR)')->required(),
                        Forms\Components\TextInput::make('subdescription_fr')->label('Subdescripción (FR)')->maxLength(255),
                    ]),
                ]),
            ]),

            Forms\Components\Section::make('Descripción')->schema([
                Forms\Components\Tabs::make('descriptions')->tabs([
                    Forms\Components\Tabs\Tab::make('ES')->schema([
                        Forms\Components\Textarea::make('description_es')->label('Descripción (ES)')->rows(5),
                    ]),
                    Forms\Components\Tabs\Tab::make('EN')->schema([
                        Forms\Components\Textarea::make('description_en')->label('Descripción (EN)')->rows(5),
                    ]),
                    Forms\Components\Tabs\Tab::make('FR')->schema([
                        Forms\Components\Textarea::make('description_fr')->label('Descripción (FR)')->rows(5),
                    ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Imagen')
                    ->disk('public')
                    ->height(40)
                    ->width(40),

                Tables\Columns\TextColumn::make('title_es')
                    ->label('Título (ES)')
                    ->limit(40)
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),

                Tables\Columns\TextColumn::make('position')
                    ->label('Orden')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('position')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Solo activos')->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar'),
                Tables\Actions\DeleteAction::make()->label('Eliminar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Eliminar seleccionados'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductCategories::route('/'),
            'create' => Pages\CreateProductCategory::route('/crear'),
            'edit' => Pages\EditProductCategory::route('/{record}/editar'),
        ];
    }
}
