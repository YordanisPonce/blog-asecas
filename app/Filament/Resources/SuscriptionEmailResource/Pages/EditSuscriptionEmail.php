<?php

namespace App\Filament\Resources\SuscriptionEmailResource\Pages;

use App\Filament\Resources\SuscriptionEmailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSuscriptionEmail extends EditRecord
{
    protected static string $resource = SuscriptionEmailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
