<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuscriptionEmailResource\Pages;
use App\Filament\Resources\SuscriptionEmailResource\RelationManagers;
use App\Models\SubscriptionEmail;
use App\Models\SuscriptionEmail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuscriptionEmailResource extends Resource
{
    
    protected static ?string $model = SubscriptionEmail::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Marketing';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label('Correo Electrónico')
                    ->placeholder('Ingrese el correo electrónico')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label('Correo Electrónico'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Creado')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Actualizado')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
               
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
            'index' => Pages\ListSuscriptionEmails::route('/'),
            'create' => Pages\CreateSuscriptionEmail::route('/create'),
            'edit' => Pages\EditSuscriptionEmail::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Suscripción de Email';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Suscripciones de Email';
    }
}
