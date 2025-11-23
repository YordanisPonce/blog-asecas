<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Carga los 3 JSON (ES manda el orden)
        $es = json_decode(file_get_contents(database_path('data/data-en.json')), true);
        $en = json_decode(file_get_contents(database_path('data/data-en.json')), true);
        $fr = json_decode(file_get_contents(database_path('data/data-fr.json')), true);

        $esCats = collect($es['categorias'] ?? []);
        $enByImage = collect($en['categorias'] ?? [])->keyBy('imagen');
        $frByImage = collect($fr['categorias'] ?? [])->keyBy('imagen');

        $order = 1;

        $esCats->each(function (array $catEs) use ($enByImage, $frByImage, &$order) {
            $img = $catEs['imagen'] ?? null;

            // Busca EN/FR por imagen para evitar problemas de ids diferentes u orden distinto
            $catEn = $img ? ($enByImage[$img] ?? []) : [];
            $catFr = $img ? ($frByImage[$img] ?? []) : [];

            $nameEs = $catEs['titulo'] ?? '';
            $nameEn = $catEn['titulo'] ?? '';
            $nameFr = $catFr['titulo'] ?? '';

            Category::updateOrCreate(
                // Clave única: slug ES (puedes cambiar si usas otra)
                ['slug' => Str::slug($nameEs)],
                [
                    'name' => $nameEs,
                    'name_en' => $nameEn,
                    'name_fr' => $nameFr,

                    'slug_en' => Str::slug($nameEn),
                    'slug_fr' => Str::slug($nameFr),

                    'image' => $img, // path tal cual viene del frontend
                    'image_alt' => $nameEs,
                    'image_title' => $nameEs,

                    'short_description_es' => $catEs['descripcion'] ?? null,
                    'short_description_en' => $catEn['descripcion'] ?? null,
                    'short_description_fr' => $catFr['descripcion'] ?? null,

                    'description_es' => $catEs['descripcion1'] ?? null,
                    'description_en' => $catEn['descripcion1'] ?? null,
                    'description_fr' => $catFr['descripcion1'] ?? null,

                    'order' => $order++,
                    'is_active' => true,
                ]
            );
        });
    }
}
