<?php
// app/Models/CategoriesPage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSeo;

class CategoriesPage extends Model
{
    use HasSeo;

    protected $table = 'categories_pages';

    protected $fillable = [
        // No necesitamos campos de contenido, solo timestamps
    ];
}
