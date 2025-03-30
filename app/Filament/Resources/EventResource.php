<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $label = 'evento';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),

                Forms\Components\DatePicker::make('date')
                    ->label('Fecha')
                    ->required(),
                Forms\Components\TimePicker::make('start_time')
                    ->label('Hora de inicio')
                    ->required(),
                Forms\Components\TimePicker::make('end_time')
                    ->label('Hora de fin')
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->label('Ubicación')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->label('Tipo')
                    ->options([
                        'Charla Jurídica' => 'Charla Jurídica',
                        'Difusión de Contenidos Jurídicos' => 'Difusión de Contenidos Jurídicos',
                    ])
                    ->required(),
                Toggle::make('active')->label('Habilitado')->columnSpanFull(),
                Forms\Components\RichEditor::make('description')->columnSpanFull()
                    ->label('Descripción')
                    ->required(),
            ])->columns(2)
        ;

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Fecha')
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Hora de inicio'),
                Tables\Columns\TextColumn::make('end_time')
                    ->label('Hora de fin'),
                Tables\Columns\TextColumn::make('location')
                    ->label('Ubicación')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo'),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
