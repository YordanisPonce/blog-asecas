<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'date',
        'start_time',
        'end_time',
        'location',
        'type',
        'slug',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    protected static array $slugAttributes = ['title'];

}
