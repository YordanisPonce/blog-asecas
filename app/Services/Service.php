<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class Service
{
    protected ?Model $record;

    public function getAll()
    {
        return $this->record->newQuery()->where('active', true)->get();
    }

    public function getBySlug(string $slug)
    {
        return $this->record->newQuery()->where('slug', $slug)->first();
    }
    public function save(array $attributes)
    {
        return $this->record->create($attributes);
    }
}