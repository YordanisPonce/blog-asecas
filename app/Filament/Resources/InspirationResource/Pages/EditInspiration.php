<?php

namespace App\Filament\Resources\InspirationResource\Pages;

use App\Filament\Resources\InspirationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInspiration extends EditRecord
{
    protected static string $resource = InspirationResource::class;

    protected static ?string $title = 'Editar imagen de inspiración';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
