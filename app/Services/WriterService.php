<?php

namespace App\Services;

use App\Models\Writer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WriterService extends Service
{
    public function __construct()
    {
        $this->record = new Writer;
        $this->with = ['blogs'];
    }
}