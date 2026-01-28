<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationSpace extends Model
{
    protected $table = 'application_space';

    protected $fillable = [
        'space_id',
        'application_id',
        'order',
    ];

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
