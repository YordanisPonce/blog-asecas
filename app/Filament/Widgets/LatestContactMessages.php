<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ContactResource;
use App\Models\Contact;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestContactMessages extends BaseWidget
{
    protected static ?string $heading = 'Últimos mensajes';
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full'; // ocupa ancho completo

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Contact::query()->latest('created_at')
            )
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->limit(25),

                Tables\Columns\TextColumn::make('email')
                    ->label('Correo')
                    ->limit(30),

                Tables\Columns\TextColumn::make('subject')
                    ->label('Asunto')
                    ->limit(35),

                Tables\Columns\BadgeColumn::make('type')
                    ->label('Tipo')
                    ->colors([
                        'primary' => 'contact',
                        'success' => 'work',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('ver')
                    ->label('Ver')
                    ->url(fn(Contact $record) => ContactResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-o-eye'),
            ])
            ->paginated([5, 10, 25])
            ->defaultPaginationPageOption(5);
    }
}
