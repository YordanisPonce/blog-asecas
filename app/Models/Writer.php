<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\Upload;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    use HasSlug, Upload;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'short_description',
        'description'
    ];


    protected static array $slugAttributes = ['name'];

    protected function image(): Attribute
    {
        $isUser = request()->input('is_user');
        return Attribute::make(
            get: fn($item) => $item && $isUser ? $this->generateUrl($item) : $item
        );
    }

    public function setImageAttribute($value)
    {
        $source = collect(explode("/", $value));
        if ($source->count() > 2) {
            $fileName = $source->pop();
            $fileFolder = $source->pop();
            $source = "$fileFolder/$fileName";
        } else {
            $source = $value;
        }

        $this->attributes['image'] = $source;
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

}
