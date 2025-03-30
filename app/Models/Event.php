<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    use HasSlug;
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
        'active'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    protected static array $slugAttributes = ['title'];

}
