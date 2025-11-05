<?php

namespace App\Filament\Resources\InspirationResource\Pages;

use App\Filament\Resources\InspirationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInspiration extends CreateRecord
{
    protected static string $resource = InspirationResource::class;
    protected static ?string $title = 'Nueva imagen de inspiración';
}
