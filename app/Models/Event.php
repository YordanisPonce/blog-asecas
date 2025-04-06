<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\Upload;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    use HasSlug, Upload;
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
        'active',
        'photo',
        'meeting_link'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    protected static array $slugAttributes = ['title'];

    protected function photo(): Attribute
    {

        $isUser = request()->input('is_user');
        return Attribute::make(
            get: fn($item) => $item && $isUser ? $this->generateUrl($item) : $item
        );

    }


    public function setPhotoAttribute($value)
    {
        $source = collect(explode("/", $value));
        if ($source->count() > 2) {
            $fileName = $source->pop();
            $fileFolder = $source->pop();
            $source = "$fileFolder/$fileName";
        } else {
            $source = $value;
        }

        $this->attributes['photo'] = $source;
    }

}
