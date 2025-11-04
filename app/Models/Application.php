<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'photo',
        'name',
        'image_alt',
        'image_title',
    ];
}
