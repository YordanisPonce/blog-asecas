<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Resources\Pages\ViewRecord;

class ViewContact extends ViewRecord
{
    protected static string $resource = ContactResource::class;

    public function mount($record): void
    {
        parent::mount($record);

        // ✅ marcar como leído apenas abre el registro
        if (filled($this->record) && ($this->record->is_read ?? null) === false) {
            $this->record->forceFill(['is_read' => true])->save();
        }
    }
}
