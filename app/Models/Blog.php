<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\Upload;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasSlug, Upload;
    protected static array $slugAttributes = ['title'];
    protected $fillable = ['title', 'description', 'slug', 'active', 'user_id', 'photo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
