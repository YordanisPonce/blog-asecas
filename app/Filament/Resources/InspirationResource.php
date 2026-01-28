<?php
// app/Filament/Resources/InspirationResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\InspirationResource\Pages;
use App\Models\Inspiration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InspirationResource extends Resource
{
    protected static ?string $model = Inspiration::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationLabel = 'Inspiración';
    protected static ?string $navigationGroup = 'Catálogo';
    protected static ?int $navigationSort = 35;

    public static function getModelLabel(): string
    {
        return 'imagen de inspiración';
    }
    public static function getPluralModelLabel(): string
    {
        return 'inspiración';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Imagen')->schema([
                Forms\Components\FileUpload::make('image_path')
                    ->label('Archivo de imagen')
                    ->image()
                    ->imageEditor()
                    ->imagePreviewHeight('220')
                    ->directory('inspirations')
                    ->disk('public')
                    ->visibility('public')
                    ->downloadable()
                    ->openable()
                    ->required(),
            ])->columns(1),

            Forms\Components\Section::make('Metadatos por idioma')->schema([
                Forms\Components\Tabs::make('i18n')->tabs([
                    Forms\Components\Tabs\Tab::make('ES')->schema([
                        Forms\Components\TextInput::make('title_es')->label('Texto/Título de la imagen (ES)')->maxLength(255),
                        Forms\Components\TextInput::make('alt_es')->label('Alt (ES)')->maxLength(255),
                    ]),
                    Forms\Components\Tabs\Tab::make('EN')->schema([
                        Forms\Components\TextInput::make('title_en')->label('Texto/Título de la imagen (EN)')->maxLength(255),
                        Forms\Components\TextInput::make('alt_en')->label('Alt (EN)')->maxLength(255),
                    ]),
                    Forms\Components\Tabs\Tab::make('FR')->schema([
                        Forms\Components\TextInput::make('title_fr')->label('Texto/Título de la imagen (FR)')->maxLength(255),
                        Forms\Components\TextInput::make('alt_fr')->label('Alt (FR)')->maxLength(255),
                    ]),
                ]),
            ])->columns(1),

            Forms\Components\Section::make('Orden y estado')->schema([
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\TextInput::make('position')->label('Orden')->numeric()->default(0),
                    Forms\Components\Toggle::make('is_active')->label('Activo')->default(true),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('position') // drag & drop por la columna `position`
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Imagen')
                    ->disk('public')
                    ->height(60)
                    ->width(80),

                Tables\Columns\TextColumn::make('title_es')
                    ->label('Título Imagen (ES)')
                    ->limit(40)
                    ->searchable(),

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
            'index' => Pages\ListInspirations::route('/'),
            'create' => Pages\CreateInspiration::route('/crear'),
            'edit' => Pages\EditInspiration::route('/{record}/editar'),
        ];
    }
}
