<?php
// app/Models/ApplicationsPage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSeo; // ← IMPORTAR EL TRAIT

class ApplicationsPage extends Model
{
    use HasSeo; // ← AÑADIR ESTA LÍNEA

    protected $table = 'applications_pages';

    protected $fillable = [
        // No necesitamos campos de contenido, solo el SEO se maneja con el trait
    ];
}
