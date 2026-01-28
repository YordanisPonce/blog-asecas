<?php

namespace App\Filament\Resources\SpaceResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;

class ApplicationLinksRelationManager extends RelationManager
{
    protected static string $relationship = 'applicationLinks';
    protected static ?string $title = 'Aplicaciones asociadas';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('application_id')
                ->label('Aplicación')
                ->options(function () {
                    $space = $this->getOwnerRecord();
                    $linked = $space->applicationLinks()->pluck('application_id');

                    return \App\Models\Application::query()
                        ->whereNotIn('id', $linked)
                        ->orderBy('name')
                        ->pluck('name', 'id');
                })
                ->searchable()
                ->preload()
                ->required(),


            Forms\Components\TextInput::make('order')
                ->label('Orden')
                ->numeric()
                ->default(0),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->reorderable('order')
            ->defaultSort('order')
            ->columns([
                Tables\Columns\TextColumn::make('application.name')
                    ->label('Aplicación')
                    ->searchable(),

                Tables\Columns\IconColumn::make('application.is_active')
                    ->label('Activa')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('order')
                    ->label('Orden')
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Vincular aplicación'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar'),
                Tables\Actions\DeleteAction::make()->label('Quitar'),
            ]);
    }
}
