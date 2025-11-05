<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Pages;
use App\Models\Application;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Aplicaciones';
    protected static ?string $navigationGroup = 'Sitio';
    protected static ?int $navigationSort = 15;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Imagen & Enlace')
                ->schema([
                    Forms\Components\TextInput::make('photo')
                        ->label('Imagen (URL)')
                        ->url()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('link_url')
                        ->label('Enlace (URL)')
                        ->url()
                        ->maxLength(255),

                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\TextInput::make('position')->numeric()->label('Orden'),
                        Forms\Components\Toggle::make('is_active')->label('Activo')->default(true),
                    ]),
                ])->columns(2),

            Forms\Components\Section::make('Nombre por idioma')
                ->schema([
                    Forms\Components\Tabs::make('names')->tabs([
                        Forms\Components\Tabs\Tab::make('ES')->schema([
                            Forms\Components\TextInput::make('name_es')
                                ->label('Nombre (ES)')
                                ->maxLength(255)
                                ->required(),
                        ]),
                        Forms\Components\Tabs\Tab::make('EN')->schema([
                            Forms\Components\TextInput::make('name_en')
                                ->label('Name (EN)')
                                ->maxLength(255)
                                ->required(),
                        ]),
                        Forms\Components\Tabs\Tab::make('FR')->schema([
                            Forms\Components\TextInput::make('name_fr')
                                ->label('Nom (FR)')
                                ->maxLength(255)
                                ->required(),
                        ]),
                    ]),
                ])->columns(1),

            Forms\Components\Section::make('Alt / Title por idioma')
                ->schema([
                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\TextInput::make('image_title_es')->label('Title (ES)'),
                        Forms\Components\TextInput::make('image_title_en')->label('Title (EN)'),
                        Forms\Components\TextInput::make('image_title_fr')->label('Title (FR)'),
                    ]),
                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\TextInput::make('image_alt_es')->label('Alt (ES)'),
                        Forms\Components\TextInput::make('image_alt_en')->label('Alt (EN)'),
                        Forms\Components\TextInput::make('image_alt_fr')->label('Alt (FR)'),
                    ]),
                ])->columns(1),

            // (Opcional) Legacy: para ver/migrar lo viejo sin usar
            Forms\Components\Section::make('Compatibilidad (legacy)')
                ->collapsible()
                ->collapsed()
                ->schema([
                    Forms\Components\TextInput::make('name')->label('name (legacy)'),
                    Forms\Components\TextInput::make('image_title')->label('image_title (legacy)'),
                    Forms\Components\TextInput::make('image_alt')->label('image_alt (legacy)'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Imagen')
                    ->circular()
                    ->extraImgAttributes(['alt' => 'application']),

                Tables\Columns\TextColumn::make('name_es')
                    ->label('Nombre (ES)')
                    ->searchable()
                    ->limit(40),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),

                Tables\Columns\TextColumn::make('position')
                    ->label('Orden')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->since() // "hace 2h"
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('position')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Solo activos')->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }
}
