<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Finish;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class FinishSeeder extends Seeder
{
    public function run(): void
    {
        $table = (new Finish())->getTable();

        $finishes = [
            [
                'slug' => 'abujardado-raspado',
                'slug_en' => 'bush-hammered-scraped',
                'slug_fr' => 'boucharde-gratte',

                'name' => '<h1 class="font-semibold text-3xl">Abujardado/raspado</h1>',
                'name_en' => '<h1 class="font-semibold text-3xl">Bush hammered / scraped</h1>',
                'name_fr' => '<h1 class="font-semibold text-3xl">Bouchardé / gratté</h1>',

                'image' => 'finishes/raspado_abujardado.jpg',
                'order' => 1,
                'description_html' => [
                    'es' => '<p class="text-lg">El acabado abujardado o raspado en morteros presenta una textura rugosa y uniforme lograda mediante el raspado superficial antes del endurecimiento. Esta solución constructiva es ideal para fachadas y muros exteriores, ya que proporciona una excelente resistencia al desgaste y a las inclemencias climáticas. El aspecto texturizado oculta imperfecciones mientras añade elegancia rústica, perfecto para proyectos que buscan robustez artesanal.</p>',
                    'en' => '<p class="text-lg">Bush hammered or scraped mortar finish provides a rough, uniform texture achieved by superficial scraping before setting. It is ideal for facades and exterior walls, offering excellent resistance to wear and weather. The textured look helps hide imperfections while adding a rustic elegance—perfect for projects seeking artisanal robustness.</p>',
                    'fr' => '<p class="text-lg">La finition bouchardée ou grattée sur mortier présente une texture rugueuse et uniforme obtenue par grattage superficiel avant durcissement. Idéale pour façades et murs extérieurs, elle offre une excellente résistance à l’usure et aux intempéries. L’aspect texturé masque les imperfections tout en apportant une élégance rustique, parfaite pour des projets recherchant une robustesse artisanale.</p>',
                ],

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

                // Según tu JSON: Mortero cal, Mortero monocapa, Mortero impreso
                'category_slugs' => ['lime-mortar', 'single-layer-mortar', 'stamped-mortar'],
            ],

            [
                'slug' => 'lavado-fratasado',
                'slug_en' => 'washed-floated',
                'slug_fr' => 'lave-taloche',

                'name' => '<h1 class="font-semibold text-3xl">Lavado/fratasado</h1>',
                'name_en' => '<h1 class="font-semibold text-3xl">Washed / floated</h1>',
                'name_fr' => '<h1 class="font-semibold text-3xl">Lavé / taloché</h1>',

                'image' => 'finishes/lavado_fratasado.jpg',
                'order' => 2,

                
                'description_html' => [
                    'es' => '<p class="text-lg">El acabado lavado o fratasado se obtiene alisando la superficie del mortero para crear una textura uniforme. Ideal para fachadas, paredes interiores y suelos, ofrece un aspecto limpio y moderno. Este acabado asegura buena adherencia para pinturas o revestimientos adicionales, con propiedades hidrófugas que previenen fisuras para una durabilidad prolongada.</p>',
                    'en' => '<p class="text-lg">The washed or floated finish is achieved by smoothing the mortar surface to create a uniform texture. Ideal for facades, interior walls, and floors, it delivers a clean, modern look. It also provides good adhesion for paints or additional coatings, with water-repellent properties that help prevent cracking for long-lasting durability.</p>',
                    'fr' => '<p class="text-lg">La finition lavée ou talochée s’obtient en lissant la surface du mortier afin de créer une texture uniforme. Idéale pour façades, murs intérieurs et sols, elle offre un rendu propre et moderne. Elle assure aussi une bonne accroche pour peintures ou revêtements, avec des propriétés hydrofuges limitant les fissures pour une durabilité accrue.</p>',
                ],

                'image_alt' => [
                    'es' => 'Acabado lavado/fratasado',
                    'en' => 'Washed / floated finish',
                    'fr' => 'Finition lavée / talochée',
                ],
                'image_title' => [
                    'es' => 'Lavado/fratasado',
                    'en' => 'Washed / floated',
                    'fr' => 'Lavé / taloché',
                ],

                // Según tu JSON: Mortero cal, Mortero monocapa, Mortero impreso
                'category_slugs' => ['lime-mortar', 'single-layer-mortar', 'stamped-mortar'],
            ],

            [
                'slug' => 'impreso',
                'slug_en' => 'printed',
                'slug_fr' => 'imprime',

                'name' => '<h1 class="font-semibold text-3xl">Impreso</h1>',
                'name_en' => '<h1 class="font-semibold text-3xl">Printed</h1>',
                'name_fr' => '<h1 class="font-semibold text-3xl">Imprimé</h1>',

                'image' => 'finishes/impreso.jpg',
                'order' => 3,

                'title_html' => [
                    'es' => '<h1 class="font-semibold text-3xl">Impreso</h1>',
                    'en' => '<h1 class="font-semibold text-3xl">Printed</h1>',
                    'fr' => '<h1 class="font-semibold text-3xl">Imprimé</h1>',
                ],
                'description_html' => [
                    'es' => '<p class="text-lg">El mortero impreso puede replicar patrones de piedra, madera, adoquines o diseños decorativos antes del endurecimiento. Ampliamente utilizado para suelos exteriores, patios y caminos debido a su resistencia al tránsito y a las condiciones climáticas. Los colores y patrones personalizables lo hacen ideal para proyectos arquitectónicos que combinan estética, funcionalidad y durabilidad.</p>',
                    'en' => '<p class="text-lg">Printed mortar can replicate stone, wood, cobblestone, or decorative patterns before setting. Widely used for outdoor floors, patios, and walkways due to its resistance to foot traffic and weather conditions. Customizable colors and patterns make it ideal for architectural projects that combine aesthetics, functionality, and durability.</p>',
                    'fr' => '<p class="text-lg">Le mortier imprimé peut reproduire des motifs de pierre, bois, pavés ou des dessins décoratifs avant durcissement. Très utilisé pour sols extérieurs, patios et allées grâce à sa résistance au trafic et aux intempéries. Ses couleurs et motifs personnalisables en font une solution idéale alliant esthétique, fonctionnalité et durabilité.</p>',
                ],

                'image_alt' => [
                    'es' => 'Acabado impreso',
                    'en' => 'Printed finish',
                    'fr' => 'Finition imprimée',
                ],
                'image_title' => [
                    'es' => 'Impreso',
                    'en' => 'Printed',
                    'fr' => 'Imprimé',
                ],

                // Según tu JSON: Mortero cal y Mortero impreso (monocapa NO lo tiene en tu JSON)
                'category_slugs' => ['lime-mortar', 'stamped-mortar'],
            ],

            [
                'slug' => 'piedra-proyectada',
                'slug_en' => 'projected-stone',
                'slug_fr' => 'pierre-projetee',

                'name' => '<h1 class="font-semibold text-3xl">Piedra proyectada</h1>',
                'name_en' => '<h1 class="font-semibold text-3xl">Projected stone</h1>',
                'name_fr' => '<h1 class="font-semibold text-3xl">Pierre projetée</h1>',

                // Renombra el archivo a piedra_proyectada.jpg para evitar %20
                'image' => 'finishes/piedra proyectada.jpg',
                'order' => 4,

                'title_html' => [
                    'es' => '<h1 class="font-semibold text-3xl">Piedra proyectada</h1>',
                    'en' => '<h1 class="font-semibold text-3xl">Projected stone</h1>',
                    'fr' => '<h1 class="font-semibold text-3xl">Pierre projetée</h1>',
                ],
                'description_html' => [
                    'es' => '<p class="text-lg">El acabado de piedra proyectada incorpora partículas de piedra natural sobre el mortero fresco mediante proyección controlada. Perfecto para fachadas y muros exteriores, ofrece una excepcional resistencia al desgaste y a las condiciones climáticas. La elegante rusticidad atemporal realza los diseños arquitectónicos con un atractivo duradero y de bajo mantenimiento.</p>',
                    'en' => '<p class="text-lg">The projected stone finish embeds natural stone particles onto fresh mortar using controlled projection. Perfect for facades and exterior walls, it offers exceptional resistance to wear and harsh weather. Its timeless rustic elegance enhances architectural designs with a durable, low-maintenance appeal.</p>',
                    'fr' => '<p class="text-lg">La finition pierre projetée incorpore des particules de pierre naturelle sur le mortier frais par projection contrôlée. Parfaite pour façades et murs extérieurs, elle offre une résistance exceptionnelle à l’usure et aux conditions climatiques. Son élégance rustique intemporelle valorise l’architecture avec un rendu durable et peu exigeant en entretien.</p>',
                ],

                'image_alt' => [
                    'es' => 'Acabado piedra proyectada',
                    'en' => 'Projected stone finish',
                    'fr' => 'Finition pierre projetée',
                ],
                'image_title' => [
                    'es' => 'Piedra proyectada',
                    'en' => 'Projected stone',
                    'fr' => 'Pierre projetée',
                ],

                // Según tu JSON: Mortero piedra decorativa
                'category_slugs' => ['decorative-stone-mortar'],
            ],

            [
                'slug' => 'liso',
                'slug_en' => 'smooth',
                'slug_fr' => 'lisse',

                'name' => '<h1 class="font-semibold text-3xl">Liso</h1>',
                'name_en' => '<h1 class="font-semibold text-3xl">Smooth</h1>',
                'name_fr' => '<h1 class="font-semibold text-3xl">Lisse</h1>',

                'image' => 'finishes/liso.jpg',
                'order' => 5,

                'title_html' => [
                    'es' => '<h1 class="font-semibold text-3xl">Liso</h1>',
                    'en' => '<h1 class="font-semibold text-3xl">Smooth</h1>',
                    'fr' => '<h1 class="font-semibold text-3xl">Lisse</h1>',
                ],
                'description_html' => [
                    'es' => '<p class="text-lg">El acabado liso crea una superficie uniforme sin textura mediante un alisado completo. Ideal para interiores modernos y fachadas minimalistas, es compatible con pinturas y revestimientos adicionales para versatilidad decorativa. Proporciona excelente protección contra la humedad y una solución constructiva atractiva.</p>',
                    'en' => '<p class="text-lg">The smooth finish creates an even, texture-free surface through complete smoothing. Ideal for modern interiors and minimalist facades, it is compatible with paints and additional coatings for decorative versatility. It provides excellent moisture protection and an attractive construction solution.</p>',
                    'fr' => '<p class="text-lg">La finition lisse crée une surface uniforme sans texture grâce à un lissage complet. Idéale pour intérieurs modernes et façades minimalistes, elle est compatible avec peintures et revêtements pour une grande polyvalence décorative. Elle offre une excellente protection contre l’humidité et une solution esthétique.</p>',
                ],

                'image_alt' => [
                    'es' => 'Acabado liso',
                    'en' => 'Smooth finish',
                    'fr' => 'Finition lisse',
                ],
                'image_title' => [
                    'es' => 'Liso',
                    'en' => 'Smooth',
                    'fr' => 'Lisse',
                ],

                // Según tu JSON: Mortero cal, Mortero monocapa, Mortero impreso
                'category_slugs' => ['lime-mortar', 'single-layer-mortar', 'stamped-mortar'],
            ],
        ];

        foreach ($finishes as $data) {
            $payload = [
                'name' => $data['name'],
                'name_en' => $data['name_en'],
                'name_fr' => $data['name_fr'],

                'slug_en' => $data['slug_en'],
                'slug_fr' => $data['slug_fr'],

                'image' => $data['image'],
                'image_alt' => $data['image_alt'],
                'image_title' => $data['image_title'],

                // Guardamos HTML directo para que Filament pueda editar el formato
                'description_es' => $data['description_html']['es'],
                'description_en' => $data['description_html']['en'],
                'description_fr' => $data['description_html']['fr'],

                'order' => $data['order'],
                'is_active' => true,
            ];

            // Si tienes columnas title_es/en/fr, las llenamos con el <h1 ...>
            if (Schema::hasColumn($table, 'title_es')) $payload['title_es'] = $data['title_html']['es'];
            if (Schema::hasColumn($table, 'title_en')) $payload['title_en'] = $data['title_html']['en'];
            if (Schema::hasColumn($table, 'title_fr')) $payload['title_fr'] = $data['title_html']['fr'];

            $finish = Finish::updateOrCreate(
                ['slug' => $data['slug']],
                $payload
            );

            $categoryIds = Category::whereIn('slug', $data['category_slugs'])->pluck('id')->all();
            if (!empty($categoryIds)) {
                $finish->categories()->sync($categoryIds);
            }
        }
    }
}
