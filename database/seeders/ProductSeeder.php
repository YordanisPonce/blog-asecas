<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDocument;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ cargar bien cada idioma (ES manda el orden)
        $es = json_decode(File::get(database_path('data/data-es.json')), true);
        $en = json_decode(File::get(database_path('data/data-en.json')), true);
        $fr = json_decode(File::get(database_path('data/data-fr.json')), true);

        $catsEs = collect($es['categorias'] ?? []);
        $catsEn = collect($en['categorias'] ?? [])->keyBy('id');
        $catsFr = collect($fr['categorias'] ?? [])->keyBy('id');

        // Alias por diferencia de ids entre ES y EN/FR (si aplica)
        $idAliases = [
            'morteroCal' => 'limeMortar',
        ];

        // Convierte arrays a texto con bullets "- item"
        $bulletText = function ($arr) {
            if (!is_array($arr)) {
                return null;
            }

            $arr = array_filter(array_map('trim', $arr));
            if (!count($arr)) {
                return null;
            }

            return collect($arr)->map(function ($x) {
                return "- " . $x;
            })->implode("\n");
        };

        // Busca producto EN/FR equivalente al ES
        $findProductMatch = function ($productsLang, $pEs, $index) {
            if (!is_array($productsLang)) {
                return null;
            }

            // 1) Match por nombre + subtitulo
            foreach ($productsLang as $p) {
                if (
                    ($p['nombre'] ?? null) === ($pEs['nombre'] ?? null) &&
                    ($p['subtitulo'] ?? null) === ($pEs['subtitulo'] ?? null)
                ) {
                    return $p;
                }
            }

            // 2) fallback por índice
            return $productsLang[$index] ?? null;
        };

        foreach ($catsEs as $catEs) {
            $catIdEs = $catEs['id'] ?? null;
            if (!$catIdEs) {
                continue;
            }

            $catIdAlt = $idAliases[$catIdEs] ?? $catIdEs;

            $catEn = $catsEn->get($catIdAlt) ?? $catsEn->get($catIdEs);
            $catFr = $catsFr->get($catIdAlt) ?? $catsFr->get($catIdEs);

            $productsEs = $catEs['productos'] ?? [];
            if (!is_array($productsEs)) {
                continue;
            }

            // ✅ buscar categoría por IMAGEN (match real con tu CategorySeeder)
            $category = Category::where('image', $catEs['imagen'] ?? null)->first();

            if (!$category) {
                Log::warning("Categoria no encontrada para imagen: " . ($catEs['imagen'] ?? 'null'));
                continue;
            }

            foreach ($productsEs as $i => $pEs) {
                $pEn = $findProductMatch($catEn['productos'] ?? [], $pEs, $i);
                $pFr = $findProductMatch($catFr['productos'] ?? [], $pEs, $i);

                $nameEs = $pEs['nombre'] ?? '';
                $nameEn = $pEn['nombre'] ?? $nameEs;
                $nameFr = $pFr['nombre'] ?? $nameEs;

                $subEs = $pEs['subtitulo'] ?? '';
                $subEn = $pEn['subtitulo'] ?? $subEs;
                $subFr = $pFr['subtitulo'] ?? $subEs;

                // Slugs únicos (hay nombres repetidos tipo KOLATEC)
                $slugEs = Str::slug(trim($nameEs . ' ' . $subEs));
                $slugEn = Str::slug(trim($nameEn . ' ' . $subEn));
                $slugFr = Str::slug(trim($nameFr . ' ' . $subFr));

                // En JSON "composicion" a veces viene como "informacion_general"
                $compositionEs = $pEs['composicion'] ?? ($pEs['informacion_general'] ?? null);
                $compositionEn = $pEn['composicion'] ?? ($pEn['informacion_general'] ?? $compositionEs);
                $compositionFr = $pFr['composicion'] ?? ($pFr['informacion_general'] ?? $compositionEs);

                $featuresEs = $bulletText($pEs['caracteristicas'] ?? []);
                $featuresEn = $bulletText($pEn['caracteristicas'] ?? ($pEs['caracteristicas'] ?? []));
                $featuresFr = $bulletText($pFr['caracteristicas'] ?? ($pEs['caracteristicas'] ?? []));

                $recoEs = $bulletText($pEs['recomendaciones'] ?? []);
                $recoEn = $bulletText($pEn['recomendaciones'] ?? ($pEs['recomendaciones'] ?? []));
                $recoFr = $bulletText($pFr['recomendaciones'] ?? ($pEs['recomendaciones'] ?? []));

                $precEs = $bulletText($pEs['precauciones'] ?? []);
                $precEn = $bulletText($pEn['precauciones'] ?? ($pEs['precauciones'] ?? []));
                $precFr = $bulletText($pFr['precauciones'] ?? ($pEs['precauciones'] ?? []));

                $relEs = $bulletText($pEs['informacion_relevante'] ?? []);
                $relEn = $bulletText($pEn['informacion_relevante'] ?? ($pEs['informacion_relevante'] ?? []));
                $relFr = $bulletText($pFr['informacion_relevante'] ?? ($pEs['informacion_relevante'] ?? []));

                $imagePath = $pEs['imagen'] ?? null;

                // ✅ crea/actualiza producto
                $product = Product::updateOrCreate(
                    [
                        'slug' => $slugEs,
                        'category_id' => $category->id,
                    ],
                    [
                        'name' => $nameEs,
                        'name_en' => $nameEn,
                        'name_fr' => $nameFr,

                        'slug_en' => $slugEn,
                        'slug_fr' => $slugFr,

                        'category_id' => $category->id,
                        'subtitle' => $subEs,

                        'image' => $imagePath,
                        'image_alt' => [
                            'es' => $nameEs,
                            'en' => $nameEn,
                            'fr' => $nameFr,
                        ],
                        'image_title' => [
                            'es' => $nameEs,
                            'en' => $nameEn,
                            'fr' => $nameFr,
                        ],

                        'composition_es' => $compositionEs,
                        'composition_en' => $compositionEn,
                        'composition_fr' => $compositionFr,

                        'features_es' => $featuresEs,
                        'features_en' => $featuresEn,
                        'features_fr' => $featuresFr,

                        'recommendations_es' => $recoEs,
                        'recommendations_en' => $recoEn,
                        'recommendations_fr' => $recoFr,

                        // JSON viene como "precauciones" -> carriers_*
                        'carriers_es' => $precEs,
                        'carriers_en' => $precEn,
                        'carriers_fr' => $precFr,

                        // "informacion_relevante" -> relevant_info_*
                        'relevant_info_es' => $relEs,
                        'relevant_info_en' => $relEn,
                        'relevant_info_fr' => $relFr,

                        'order' => $i + 1,
                        'is_active' => true,
                    ]
                );

                /* =========================================================
                   ✅ DOCUMENTOS DEL PRODUCTO
                   ========================================================= */

                // Preferimos ES; si no hay, caemos a EN o FR (PHP 7.2 safe)
                $docs = [];
                if (!empty($pEs['documentacion']) && is_array($pEs['documentacion'])) {
                    $docs = $pEs['documentacion'];
                } elseif (!empty($pEn['documentacion']) && is_array($pEn['documentacion'])) {
                    $docs = $pEn['documentacion'];
                } elseif (!empty($pFr['documentacion']) && is_array($pFr['documentacion'])) {
                    $docs = $pFr['documentacion'];
                }

                foreach ($docs as $dIndex => $doc) {
                    $filePath = $doc['enlace'] ?? null;
                    if (!$filePath) {
                        continue;
                    }

                    $docName = $doc['nombre'] ?? 'Documento';
                    $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                    ProductDocument::updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'file_path' => $filePath,
                        ],
                        [
                            'name' => $docName,
                            'file_type' => $fileType ?: null,
                            'order' => $dIndex + 1,
                        ]
                    );
                }
            }
        }
    }
}
