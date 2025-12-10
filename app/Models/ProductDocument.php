<?php

namespace App\Models;

use Illuminate\Container\Attributes\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'file_path',
        'file_type',
        'order',
    ];

    protected $appends = ['file_url'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Obtener extensión del archivo
    public function getFileExtensionAttribute()
    {
        return pathinfo($this->file_path, PATHINFO_EXTENSION);
    }

    // Obtener nombre del archivo sin extensión
    public function getFileNameAttribute()
    {
        return pathinfo($this->file_path, PATHINFO_FILENAME);
    }

    // Obtener tamaño del archivo (necesitarías implementar esto)
    public function getFileSizeAttribute()
    {
        if (file_exists(storage_path('app/public/' . $this->file_path))) {
            return number_format(filesize(storage_path('app/public/' . $this->file_path)) / 1024, 2) . ' KB';
        }
        return 'N/A';
    }

    public function getFileUrlAttribute()
    {
        return Storage::disk('public')->url($this->file_path);
    }
}