<?php
namespace App\Services;
use App\Models\Blog;

class BlogService extends Service
{
    public function __construct()
    {
        $this->record = new Blog;
    }

}
