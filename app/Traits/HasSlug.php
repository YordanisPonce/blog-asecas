<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Str;

trait HasSlug
{

    /**
     * Lista de atributos que deben convertirse en slugs.
     *
     * @var array
     */

    /**
     * Boot del trait para registrar los mutadores dinámicos.
     */
    protected static function bootHasSlug()
    {
        static::saving(function ($model) {
            foreach ($model->getSlugAttributes() as $attribute) {
                if (!empty($model->{$attribute})) {
                    $model->slug = static::generateSlug($model->{$attribute});
                }
            }
        });
    }

    /**
     * Obtén la lista de atributos que deben transformarse en slugs.
     *
     * @return array
     */
    protected function getSlugAttributes(): array
    {
        return static::$slugAttributes;
    }

    /**
     * Genera un slug a partir de un valor dado.
     *
     * @param string $value
     * @return string
     */
    protected static function generateSlug(string $value): string
    {
        return Str::slug($value);
    }
}
