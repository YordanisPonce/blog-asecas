<?php

namespace Database\Seeders;

use App\Models\Inspiration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class InspirationSeeder extends Seeder
{
    public function run(): void
    {
        // MISMO ORDEN que tu array del front
        $items = [
            // 1) /convertedImages/image1.webp
            [
                'image_path' => 'inspirations/image1.webp',
                'alt_key' => 'contemporaryArchitecture',
                'position' => 0,
            ],
            // 2) /convertedImages/img-8.webp
            [
                'image_path' => 'inspirations/img-8.webp',
                'alt_key' => 'urbanArchitecture',
                'position' => 1,
            ],
            // 3) /convertedImages/img-3.webp
            [
                'image_path' => 'inspirations/img-3.webp',
                'alt_key' => 'minimalistDesign',
                'position' => 2,
            ],
            // 4) /convertedImages/img1.webp
            [
                'image_path' => 'inspirations/img1.webp',
                'alt_key' => 'minimalistDesign',
                'position' => 3,
            ],
            // 5) /convertedImages/aplicaciones/terraza.webp
            [
                'image_path' => 'inspirations/terraza.webp',
                'alt_key' => 'modernFacade',
                'position' => 4,
            ],
            // 6) /convertedImages/img-4.webp
            [
                'image_path' => 'inspirations/img-4.webp',
                'alt_key' => 'contemporaryArchitecture',
                'position' => 5,
            ],
            // 7) /convertedImages/Home.webp
            [
                'image_path' => 'inspirations/Home.webp',
                'alt_key' => 'urbanArchitecture',
                'position' => 6,
            ],
            // 8) /convertedImages/inspiracion/DSC_0013.webp
            [
                'image_path' => 'inspirations/DSC_0013.webp',
                'alt_key' => 'architecturalFacadeDetail',
                'position' => 7,
            ],
            // 9) /convertedImages/inspiracion/Fachadas Raspado 012.webp
            [
                'image_path' => 'inspirations/Fachadas Raspado 012.webp',
                'alt_key' => 'scrapedFacadeFinish',
                'position' => 8,
            ],
            // 10) /convertedImages/inspiracion/Fachadas Raspado 021.webp
            [
                'image_path' => 'inspirations/Fachadas Raspado 021.webp',
                'alt_key' => 'texturedWallFinish',
                'position' => 9,
            ],
            // 11) /convertedImages/inspiracion/Fachadas Raspado 025.webp
            [
                'image_path' => 'inspirations/Fachadas Raspado 025.webp',
                'alt_key' => 'modernExteriorWallTexture',
                'position' => 10,
            ],
            // 12) /convertedImages/inspiracion/Fachadas Raspado 028.webp
            [
                'image_path' => 'inspirations/Fachadas Raspado 028.webp',
                'alt_key' => 'architecturalWallTreatment',
                'position' => 11,
            ],
            // 13) /convertedImages/inspiracion/Monocapa Impreso 2.webp
            [
                'image_path' => 'inspirations/Monocapa Impreso 2.webp',
                'alt_key' => 'printedMonocoucheFinish',
                'position' => 12,
            ],
            // 14) /convertedImages/inspiracion/Monocapa Impreso 9.webp
            [
                'image_path' => 'inspirations/Monocapa Impreso 9.webp',
                'alt_key' => 'decorativeConcreteTexture',
                'position' => 13,
            ],
            // 15) /convertedImages/inspiracion/Monocapa Impreso 13.webp
            [
                'image_path' => 'inspirations/Monocapa Impreso 13.webp',
                'alt_key' => 'architecturalSurfacePattern',
                'position' => 14,
            ],
            // 16) /convertedImages/inspiracion/Monocouche Pasta Chino 6.webp
            [
                'image_path' => 'inspirations/Monocouche Pasta Chino 6.webp',
                'alt_key' => 'chinesePasteFinishDetail',
                'position' => 15,
            ],
            // 17) /convertedImages/inspiracion/Monocouche Pasta Chino 9.webp
            [
                'image_path' => 'inspirations/Monocouche Pasta Chino 9.webp',
                'alt_key' => 'decorativeWallTreatment',
                'position' => 16,
            ],
            // 18) /convertedImages/inspiracion/Monocouche Pasta Chino 11.webp
            [
                'image_path' => 'inspirations/Monocouche Pasta Chino 11.webp',
                'alt_key' => 'specialtyPlasterFinish',
                'position' => 17,
            ],
            // 19) /convertedImages/inspiracion/Monocouche Pasta Chino 15.webp
            [
                'image_path' => 'inspirations/Monocouche Pasta Chino 15.webp',
                'alt_key' => 'architecturalTextureDetail',
                'position' => 18,
            ],
            // 20) /convertedImages/inspiracion/Monocouche Pasta Chino 27.webp
            [
                'image_path' => 'inspirations/Monocouche Pasta Chino 27.webp',
                'alt_key' => 'contemporaryWallFinish',
                'position' => 19,
            ],
        ];

        // Textos ALT por clave (ES/EN/FR)
        $alts = [
            'contemporaryArchitecture' => [
                'es' => 'Arquitectura contemporánea',
                'en' => 'Contemporary architecture',
                'fr' => 'Architecture contemporaine',
            ],
            'urbanArchitecture' => [
                'es' => 'Arquitectura urbana',
                'en' => 'Urban architecture',
                'fr' => 'Architecture urbaine',
            ],
            'minimalistDesign' => [
                'es' => 'Diseño de edificio minimalista',
                'en' => 'Minimalist building design',
                'fr' => 'Design de bâtiment minimaliste',
            ],
            'modernFacade' => [
                'es' => 'Detalle de fachada moderna',
                'en' => 'Modern facade detail',
                'fr' => 'Détail de façade moderne',
            ],

            // Nuevas descripciones (no estaban en tus traducciones viejas)
            'architecturalFacadeDetail' => [
                'es' => 'Detalle arquitectónico de fachada',
                'en' => 'Architectural facade detail',
                'fr' => 'Détail architectural de façade',
            ],
            'scrapedFacadeFinish' => [
                'es' => 'Acabado de fachada raspada',
                'en' => 'Scraped facade finish',
                'fr' => 'Finition de façade grattée',
            ],
            'texturedWallFinish' => [
                'es' => 'Acabado de pared texturizada',
                'en' => 'Textured wall finish',
                'fr' => 'Finition de mur texturé',
            ],
            'modernExteriorWallTexture' => [
                'es' => 'Textura moderna de pared exterior',
                'en' => 'Modern exterior wall texture',
                'fr' => 'Texture moderne de mur extérieur',
            ],
            'architecturalWallTreatment' => [
                'es' => 'Tratamiento arquitectónico de pared',
                'en' => 'Architectural wall treatment',
                'fr' => 'Traitement architectural du mur',
            ],
            'printedMonocoucheFinish' => [
                'es' => 'Acabado monocapa impreso',
                'en' => 'Printed monocouche finish',
                'fr' => 'Finition monocouche imprimée',
            ],
            'decorativeConcreteTexture' => [
                'es' => 'Textura decorativa tipo hormigón',
                'en' => 'Decorative concrete texture',
                'fr' => 'Texture décorative type béton',
            ],
            'architecturalSurfacePattern' => [
                'es' => 'Patrón arquitectónico de superficie',
                'en' => 'Architectural surface pattern',
                'fr' => 'Motif architectural de surface',
            ],
            'chinesePasteFinishDetail' => [
                'es' => 'Detalle de acabado pasta china',
                'en' => 'Chinese paste finish detail',
                'fr' => 'Détail de finition pâte chinoise',
            ],
            'decorativeWallTreatment' => [
                'es' => 'Tratamiento decorativo de pared',
                'en' => 'Decorative wall treatment',
                'fr' => 'Traitement décoratif du mur',
            ],
            'specialtyPlasterFinish' => [
                'es' => 'Acabado especial de revestimiento',
                'en' => 'Specialty plaster finish',
                'fr' => 'Finition spéciale d’enduit',
            ],
            'architecturalTextureDetail' => [
                'es' => 'Detalle de textura arquitectónica',
                'en' => 'Architectural texture detail',
                'fr' => 'Détail de texture architecturale',
            ],
            'contemporaryWallFinish' => [
                'es' => 'Acabado contemporáneo de pared',
                'en' => 'Contemporary wall finish',
                'fr' => 'Finition contemporaine du mur',
            ],
        ];

        $table = (new Inspiration())->getTable();

        foreach ($items as $i => $row) {
            $n = $i + 1;
            $altPack = $alts[$row['alt_key']] ?? ['es' => null, 'en' => null, 'fr' => null];

            $payload = [
                'position' => $row['position'],
                'is_active' => true,
            ];

            // Titles
            if (Schema::hasColumn($table, 'title_es')) $payload['title_es'] = "Caso real {$n}";
            if (Schema::hasColumn($table, 'title_en')) $payload['title_en'] = "Real case {$n}";
            if (Schema::hasColumn($table, 'title_fr')) $payload['title_fr'] = "Cas réel {$n}";

            // Alts
            if (Schema::hasColumn($table, 'alt_es')) $payload['alt_es'] = $altPack['es'];
            if (Schema::hasColumn($table, 'alt_en')) $payload['alt_en'] = $altPack['en'];
            if (Schema::hasColumn($table, 'alt_fr')) $payload['alt_fr'] = $altPack['fr'];

            Inspiration::updateOrCreate(
                ['image_path' => $row['image_path']],
                $payload
            );
        }
    }
}
