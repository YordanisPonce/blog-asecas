<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\Upload;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasSlug, Upload;
    protected static array $slugAttributes = ['title'];
    protected $fillable = ['title', 'description', 'slug', 'active', 'user_id', 'photo', 'notified', // 👇 nuevos campos SEO
        'meta_title_es',
        'meta_title_en',
        'meta_title_fr',
        'meta_description_es',
        'meta_description_en',
        'meta_description_fr',
        'meta_keywords_es',
        'meta_keywords_en',
        'meta_keywords_fr',
        'og_title_es',
        'og_title_en',
        'og_title_fr',
        'og_description_es',
        'og_description_en',
        'og_description_fr',
        'og_image',];

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


    public function writer()
    {
        return $this->belongsTo(Writer::class);
    }

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    // 👇 AÑADIR MÉTODOS HELPER SEO
    public function getMetaTitle(string $lang): ?string
    {
        $seoValue = $this->{"meta_title_{$lang}"};
        if (!empty($seoValue)) return $seoValue;
        return $this->title; // fallback al título de la noticia
    }

    public function getMetaDescription(string $lang): ?string
    {
        $seoValue = $this->{"meta_description_{$lang}"};
        if (!empty($seoValue)) return $seoValue;
        // fallback a un extracto de la descripción (sin HTML)
        $plainText = strip_tags($this->description ?? '');
        return substr($plainText, 0, 160);
    }

    public function getMetaKeywords(string $lang): ?string
    {
        return $this->{"meta_keywords_{$lang}"} ?? null;
    }

    public function getOgTitle(string $lang): ?string
    {
        $ogValue = $this->{"og_title_{$lang}"};
        if (!empty($ogValue)) return $ogValue;
        return $this->getMetaTitle($lang);
    }

    public function getOgDescription(string $lang): ?string
    {
        $ogValue = $this->{"og_description_{$lang}"};
        if (!empty($ogValue)) return $ogValue;
        return $this->getMetaDescription($lang);
    }

    public function getOgImageUrl(): ?string
    {
        if ($this->og_image) {
            return Storage::disk('public')->url($this->og_image);
        }
        return $this->photo ? Storage::disk('public')->url($this->photo) : null;
    }

}
