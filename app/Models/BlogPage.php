<?php
// app/Models/BlogPage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSeo;

class BlogPage extends Model
{
    use HasSeo;

    protected $table = 'blog_pages';

    protected $fillable = [];
}
