<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationGroup = 'Atención al cliente';
    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    public static function getModelLabel(): string
    {
        return 'Mensaje de contacto';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Mensajes de contacto';
    }

    public static function getNavigationLabel(): string
    {
        return 'Mensajes de contacto';
    }
    protected static ?int $navigationSort = 80;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('Nombre')

                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('email')
                    ->label('Correo')
                    ->email()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('message')->label('Mensaje')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Correo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('phone')->label('Teléfono')->searchable(),
                Tables\Columns\TextColumn::make('subject')->label('Asunto')->searchable(),
            Tables\Columns\TextColumn::make('cv_original_name')
                ->label('CV')
                ->url(fn($record) => $record->cv_url)
                ->openUrlInNewTab()
                ->placeholder('-')
            ,

            Tables\Columns\BadgeColumn::make('type')
                ->label('Tipo')
                ->colors([
                    'primary' => 'contact',
                    'success' => 'work',
                ])
                ->sortable(),

            Tables\Columns\IconColumn::make('consent_privacy')->label('Privacidad')->boolean(),
                Tables\Columns\IconColumn::make('consent_commercial')->label('Comercial')->boolean(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                /*   Tables\Actions\EditAction::make(), */
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'view' => Pages\ViewContact::route('/{record}'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
