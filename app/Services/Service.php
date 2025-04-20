<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Service
{
    protected ?Model $record;
    protected array $with = [];
    public function getAll()
    {
        $query = $this->record->newQuery()->with($this->with);
        if (Schema::hasColumn($this->record->getTable(), 'active')) {
            $query->where('active', true);
        }
        return $query->get();
    }

    public function getBySlug(string $slug)
    {
        return $this->record->newQuery()->with($this->with)->where('slug', $slug)->first();
    }
    public function save(array $attributes)
    {
        $record = $this->record->create($attributes);
        return $this->getById($record->id);
    }

    public function update(array $attributes, $id)
    {
        return $this->record->find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->record->find($id)->delete();
    }

    public function getById($id)
    {
        return $this->record->find($id);
    }

    public function getByAttributes(array $attributes)
    {
        return $this->record->newQuery()->with($this->with)->where($attributes)->get();
    }



    public function query()
    {
        return $this->record->newQuery();
    }
}