<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Resources\Pages\EditRecord;

class EditContact extends EditRecord
{
    protected static string $resource = ContactResource::class;

    public function mount($record): void
    {
        parent::mount($record);

        if (filled($this->record) && ($this->record->is_read ?? null) === false) {
            $this->record->forceFill(['is_read' => true])->save();
        }
    }
}
