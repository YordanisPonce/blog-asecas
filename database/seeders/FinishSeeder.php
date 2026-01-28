<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Finish;
use Illuminate\Database\Seeder;

class FinishSeeder extends Seeder
{
    public function run(): void
    {
        $finish = Finish::updateOrCreate(
            ['slug' => 'abujardado-raspado'],
            [
                'name' => 'Abujardado/raspado',
                'name_en' => 'Bush hammered / scraped',
                'name_fr' => 'Bouchardé / gratté',

                'slug_en' => 'bush-hammered-scraped',
                'slug_fr' => 'boucharde-gratte',

                'image' => 'finishes/abujardado.jpg',

                'image_alt' => [
                    'es' => 'Acabado abujardado/raspado',
                    'en' => 'Bush hammered / scraped finish',
                    'fr' => 'Finition bouchardée / grattée',
                ],
                'image_title' => [
                    'es' => 'Abujardado/raspado',
                    'en' => 'Bush hammered / scraped',
                    'fr' => 'Bouchardé / gratté',
                ],

                'description_es' =>
                'El acabado abujardado o raspado en morteros presenta una textura rugosa y uniforme lograda mediante el raspado superficial antes del endurecimiento. ' .
                    'Esta solución constructiva es ideal para fachadas y muros exteriores, ya que proporciona una excelente resistencia al desgaste y a las inclemencias climáticas. ' .
                    'El aspecto texturizado oculta imperfecciones mientras añade elegancia rústica, perfecto para proyectos que buscan robustez artesanal.',

                'description_en' =>
                'Bush hammered or scraped mortar finish provides a rough, uniform texture achieved by superficial scraping before setting. ' .
                    'It is ideal for facades and exterior walls, offering excellent resistance to wear and weather. ' .
                    'The textured look helps hide imperfections while adding a rustic elegance—perfect for projects seeking artisanal robustness.',

                'description_fr' =>
                'La finition bouchardée ou grattée sur mortier présente une texture rugueuse et uniforme obtenue par grattage superficiel avant durcissement. ' .
                    'Idéale pour façades et murs extérieurs, elle offre une excellente résistance à l’usure et aux intempéries. ' .
                    'L’aspect texturé masque les imperfections tout en apportant une élégance rustique, parfaite pour des projets recherchant une robustesse artisanale.',

                'order' => 1,
                'is_active' => true,
            ]
        );

        // Asocia categorías que representen esos 3 cuadritos.
        // Puedes cambiar los slugs por los reales en tu BD:
        $categorySlugs = [
            'lime-mortar', // Mortero cal (ejemplo)
            'stamped-mortar',
            'water-protector',
        ];

        $categoryIds = Category::whereIn('slug', $categorySlugs)->pluck('id')->all();

        if (!empty($categoryIds)) {
            // sincroniza sin borrar otras relaciones si quieres:
            $finish->categories()->syncWithoutDetaching($categoryIds);
        }
    }
}
