<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $es = json_decode(File::get(database_path('data/data-es.json')), true);
        $en = json_decode(File::get(database_path('data/data-en.json')), true);
        $fr = json_decode(File::get(database_path('data/data-fr.json')), true);

        $catsEs = collect($es['categorias'] ?? []);
        $catsEn = collect($en['categorias'] ?? [])->keyBy('id');
        $catsFr = collect($fr['categorias'] ?? [])->keyBy('id');

        // Si algunos IDs difieren entre idiomas (tu ya lo usas en ProductSeeder)
        $idAliases = [
            'morteroCal' => 'limeMortar',
        ];

        foreach ($catsEs as $i => $catEs) {
            $idEs = $catEs['id'] ?? null;
            if (!$idEs) continue;

            $idAlt = $idAliases[$idEs] ?? $idEs;

            $catEn = $catsEn->get($idAlt) ?? $catsEn->get($idEs);
            $catFr = $catsFr->get($idAlt) ?? $catsFr->get($idEs);

            $nameEs = $catEs['titulo'] ?? '';
            $nameEn = $catEn['titulo'] ?? $nameEs;
            $nameFr = $catFr['titulo'] ?? $nameEs;

            $slugEs = Str::slug($nameEs);
            $slugEn = Str::slug($nameEn);
            $slugFr = Str::slug($nameFr);

            // OJO: en tu JSON hay descripcion y descripcion1.
            // Aquí los uno con salto de línea (texto plano).
            $descEs = trim(($catEs['descripcion'] ?? '') . "\n\n" . ($catEs['descripcion1'] ?? ''));
            $descEn = trim(($catEn['descripcion'] ?? '') . "\n\n" . ($catEn['descripcion1'] ?? ''));
            $descFr = trim(($catFr['descripcion'] ?? '') . "\n\n" . ($catFr['descripcion1'] ?? ''));

            $image = $catEs['imagen'] ?? null; // esto es CLAVE para que ProductSeeder haga match

            Category::updateOrCreate(
                [
                    // estable: usamos slug ES como llave (puedes cambiar a image si prefieres)
                    'slug' => $slugEs,
                ],
                [
                    'name' => $nameEs,
                    'name_en' => $nameEn,
                    'name_fr' => $nameFr,

                    'slug_en' => $slugEn,
                    'slug_fr' => $slugFr,

                    'image' => $image,

                    // si quieres, puedes usar short_description como el primer párrafo
                    'short_description_es' => $catEs['descripcion'] ?? null,
                    'short_description_en' => $catEn['descripcion'] ?? ($catEs['descripcion'] ?? null),
                    'short_description_fr' => $catFr['descripcion'] ?? ($catEs['descripcion'] ?? null),

                    // descripción completa (texto plano)
                    'description_es' => $descEs ?: null,
                    'description_en' => $descEn ?: null,
                    'description_fr' => $descFr ?: null,

                    'order' => $i + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
