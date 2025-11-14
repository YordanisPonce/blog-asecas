<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Obtener categoría de Lime Mortar
        $limeMortarCategory = Category::where('slug', 'lime-mortar')->first();

        if ($limeMortarCategory) {
            $products = [
                [
                    'name' => 'NHL LIME MORTAR',
                    'slug' => 'nhl-lime-mortar',
                    'category_id' => $limeMortarCategory->id,
                    'subtitle' => 'Lime mortar',
                    'composition_en' => 'Mortar based on pure Natural Hydraulic Lime (NHL) selected aggregates and additives that provide a high-quality product for coatings, walls and surface repairs.',
                    'composition_es' => 'Mortero a base de Cal Hidráulica Natural (NHL) pura, áridos seleccionados y aditivos que proporcionan un producto de alta calidad para revestimientos, muros y reparaciones de superficies.',
                    'composition_fr' => 'Mortier à base de chaux hydraulique naturelle (NHL) pure, granulats sélectionnés et additifs qui fournissent un produit de haute qualité pour les revêtements, murs et réparations de surfaces.',
                    'features_en' => "- High compression and flexural strength with quick drying.\n- Breathable, allowing moisture evacuation and preventing salt accumulation.\n- Ideal for restoration and conservation of architectural heritage.\n- High adhesion to both traditional and modern surfaces.\n- Does not emit volatile organic compounds (VOCs), making it an ecological option.\n- Water resistant while allowing environmental moisture evaporation.\n- Compatible with thermal insulation systems (ETICS).\n- Suitable for applications on murals, facades, brick walls, natural stone and other porous surfaces.",
                    'features_es' => "- Alta resistencia a compresión y flexión con secado rápido.\n- Transpirable, permitiendo la evacuación de humedad y evitando acumulación de sales.\n- Ideal para restauración y conservación del patrimonio arquitectónico.\n- Alta adherencia tanto en superficies tradicionales como modernas.\n- No emite compuestos orgánicos volátiles (COV), siendo una opción ecológica.\n- Resistente al agua permitiendo la evaporación de la humedad ambiental.\n- Compatible con sistemas de aislamiento térmico (ETICS).\n- Apto para aplicaciones en murales, fachadas, muros de ladrillo, piedra natural y otras superficies porosas.",
                    'presentation' => '25 kg bags',
                    'pallet_info' => 'Pallet of 1600 kg (56 bags)',
                    'storage_info' => '12 months from manufacturing date in a dry, ventilated and cool place',
                    'order' => 1,
                    'is_active' => true,
                ],
            ];

            foreach ($products as $productData) {
                Product::create($productData);
            }
        }
    }
}