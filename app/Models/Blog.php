<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasSlug;
    protected static array $slugAttributes = ['title'];
    protected $fillable = ['title', 'description', 'slug', 'active', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
