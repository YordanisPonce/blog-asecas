<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Space;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpacesSeeder extends Seeder
{
    public function run(): void
    {
        $spaces = [
            [
                'slug' => 'facades',
                'title' => [
                    'es' => 'Fachadas',
                    'en' => 'Facades',
                    'fr' => 'Façades',
                ],
                'image' => '/spaces/images/fachadas.jpg',
                'description' => [
                    'es' => 'Las fachadas son uno de los elementos arquitectónicos más visibles y expuestos de un edificio, por lo que requieren soluciones constructivas que combinen protección, estética y eficiencia. Los revestimientos con mortero monocapa o materiales cerámicos ofrecen una excelente resistencia frente a la humedad, radiación solar y cambios de temperatura. Además, las fachadas ventiladas mejoran el aislamiento térmico, contribuyendo a la eficiencia energética. Los acabados decorativos permiten personalizar el diseño y potenciar el carácter visual de la construcción.',
                    'en' => 'Facades are one of the most visible and exposed architectural elements of a building, requiring construction solutions that combine protection, aesthetics and efficiency. Coatings with Single layer Mortar or ceramic materials offer excellent resistance to moisture, solar radiation and temperature changes. Additionally, ventilated facades improve thermal insulation, contributing to energy efficiency. Decorative finishes allow customization of the design and enhancement of the building\'s visual character.',
                    'fr' => 'Les façades sont l’un des éléments architecturaux les plus visibles et exposés d’un bâtiment. Elles nécessitent des solutions constructives qui combinent protection, esthétique et efficacité. Les revêtements en mortier monocouche ou en matériaux céramiques offrent une excellente résistance à l’humidité, au rayonnement solaire et aux variations de température. De plus, les façades ventilées améliorent l’isolation thermique et contribuent à l’efficacité énergétique. Les finitions décoratives permettent de personnaliser le design et de renforcer le caractère visuel du bâtiment.',
                ],
                'applications' => ['coatings', 'plasters', 'masonry', 'thermalInsulation', 'waterproofing', 'dehumidification'],
            ],

            [
                'slug' => 'terraces',
                'title' => [
                    'es' => 'Terrazas',
                    'en' => 'Terraces',
                    'fr' => 'Terrasses',
                ],
                'image' => '/spaces/images/terrazas.jpg',
                'description' => [
                    'es' => 'Las terrazas son espacios exteriores que amplían las áreas habitables de los edificios. Su construcción requiere soluciones que garanticen impermeabilización, resistencia al tránsito y durabilidad. El uso de morteros impermeabilizantes y pavimentos antideslizantes es esencial para proteger la superficie y asegurar un entorno seguro. Además, el diseño arquitectónico puede integrar mobiliario fijo y jardineras para crear ambientes funcionales y confortables. Las terrazas bien diseñadas mejoran la calidad de vida y aportan valor estético al edificio.',
                    'en' => 'Terraces are outdoor spaces that expand the habitable areas of buildings. Their construction requires solutions that guarantee waterproofing, traffic resistance and durability. The use of waterproofing mortars and anti-slip pavements is essential to protect the surface and ensure a safe environment. Additionally, architectural design can integrate fixed furniture and planters to create functional and comfortable environments. Well-designed terraces improve quality of life and add aesthetic value to buildings.',
                    'fr' => 'Les terrasses sont des espaces extérieurs qui prolongent les surfaces habitables des bâtiments. Leur construction requiert des solutions garantissant l’étanchéité, la résistance au passage et la durabilité. L’utilisation de mortiers d’étanchéité et de revêtements antidérapants est essentielle pour protéger la surface et assurer un environnement sûr. Le design architectural peut également intégrer du mobilier fixe et des jardinières afin de créer des espaces fonctionnels et confortables. Des terrasses bien conçues améliorent la qualité de vie et ajoutent une valeur esthétique au bâtiment.',
                ],
                'applications' => ['coatings', 'plasters', 'masonry', 'tiles', 'thermalInsulation', 'waterproofing', 'dehumidification'],
            ],

            [
                'slug' => 'balconies',
                'title' => [
                    'es' => 'Balcones',
                    'en' => 'Balconies',
                    'fr' => 'Balcons',
                ],
                'image' => '/spaces/images/balcones.jpg',
                'description' => [
                    'es' => 'Los balcones son extensiones arquitectónicas que aportan luz y ventilación a las viviendas. Su construcción debe considerar soluciones estructurales y revestimientos resistentes a la intemperie. Los pavimentos antideslizantes y los sistemas de impermeabilización garantizan durabilidad y seguridad. Además, el uso de barandillas modernas y acabados decorativos permite integrarlos en el diseño general del edificio, mejorando funcionalidad y estética.',
                    'en' => 'Balconies are architectural extensions that provide light and ventilation to homes. Their construction must consider structural solutions and coatings resistant to weather conditions. Anti-slip pavements and waterproofing systems guarantee their durability and safety. Additionally, the use of modern railings and decorative finishes allows their integration into the overall building design, improving functionality and aesthetics.',
                    'fr' => 'Les balcons sont des extensions architecturales qui apportent lumière et ventilation aux logements. Leur construction doit intégrer des solutions structurelles et des revêtements résistants aux intempéries. Les revêtements antidérapants et les systèmes d’étanchéité garantissent durabilité et sécurité. De plus, l’utilisation de garde-corps modernes et de finitions décoratives permet de les intégrer harmonieusement au design global du bâtiment, améliorant fonctionnalité et esthétique.',
                ],
                'applications' => ['coatings', 'plasters', 'masonry', 'thermalInsulation', 'waterproofing'],
            ],

            [
                'slug' => 'walls',
                'title' => [
                    'es' => 'Paredes',
                    'en' => 'Walls',
                    'fr' => 'Murs',
                ],
                'image' => '/spaces/images/paredes.jpg',
                'description' => [
                    'es' => 'Las paredes son elementos estructurales y decorativos esenciales en cualquier construcción. Las soluciones incluyen morteros monocapa para revestimientos exteriores, ofreciendo protección y acabados estéticos en una sola aplicación. En interiores, los morteros de cal garantizan transpirabilidad y un acabado fino. Las paredes pueden combinarse con elementos decorativos como lucernarios, paneles acústicos o revestimientos cerámicos, mejorando tanto la funcionalidad como el diseño del espacio.',
                    'en' => 'Walls are essential structural and decorative elements in any construction. Construction solutions include Single layer Mortars for exterior coatings, offering protection and aesthetic finishes in a single application. For interiors, lime mortars guarantee breathability and a fine finish. Walls can be combined with decorative elements such as skylights, acoustic panels or ceramic coatings, improving both functionality and space design.',
                    'fr' => 'Les murs sont des éléments structurels et décoratifs essentiels dans toute construction. Les solutions incluent des mortiers monocouches pour les revêtements extérieurs, offrant protection et finitions esthétiques en une seule application. En intérieur, les mortiers à la chaux garantissent respirabilité et finition fine. Les murs peuvent être associés à des éléments décoratifs tels que puits de lumière, panneaux acoustiques ou revêtements céramiques, améliorant à la fois la fonctionnalité et le design des espaces.',
                ],
                'applications' => ['coatings', 'plasters', 'masonry', 'tiles', 'waterproofing', 'dehumidification'],
            ],

            [
                'slug' => 'patios',
                'title' => [
                    'es' => 'Patios y lucernarios',
                    'en' => 'Patios and skylights',
                    'fr' => 'Patios et puits de lumière',
                ],
                'image' => '/spaces/images/patiosylucernarios.jpg',
                'description' => [
                    'es' => 'Los patios y lucernarios son soluciones arquitectónicas que mejoran la iluminación natural y la ventilación de los espacios interiores. Los patios requieren pavimentos impermeables y resistentes al tránsito, mientras que los lucernarios deben incorporar materiales transparentes de alta resistencia y sistemas de sellado eficientes. El diseño arquitectónico de estos espacios permite crear ambientes luminosos, confortables y visualmente atractivos, aportando valor al edificio.',
                    'en' => 'Patios and skylights are architectural solutions that improve natural lighting and ventilation of interior spaces. Patios require waterproof and traffic-resistant pavements, while skylights should incorporate high-strength transparent materials and efficient sealing systems. The architectural design of these spaces allows creating bright, comfortable and visually attractive environments, adding value to buildings.',
                    'fr' => 'Les patios et puits de lumière sont des solutions architecturales qui améliorent l’éclairage naturel et la ventilation des espaces intérieurs. Les patios nécessitent des revêtements étanches et résistants au passage, tandis que les puits de lumière doivent intégrer des matériaux transparents à haute résistance et des systèmes d’étanchéité efficaces. Leur conception permet de créer des environnements lumineux, confortables et visuellement attractifs, ajoutant de la valeur au bâtiment.',
                ],
                'applications' => ['coatings', 'plasters', 'masonry', 'tiles', 'waterproofing', 'dehumidification'],
            ],

            [
                'slug' => 'floors',
                'title' => [
                    'es' => 'Suelos y pavimentos',
                    'en' => 'Floors and pavements',
                    'fr' => 'Sols et revêtements',
                ],
                'image' => '/spaces/images/pavimentos.jpg',
                'description' => [
                    'es' => 'Los suelos y pavimentos son fundamentales en cualquier espacio arquitectónico, ya que deben combinar resistencia, estética y funcionalidad. Los morteros autonivelantes y los pavimentos de alta resistencia ofrecen superficies uniformes y duraderas. En exteriores, los pavimentos antideslizantes e impermeables son esenciales para garantizar seguridad y protección frente a la humedad. Las soluciones constructivas deben adaptarse a las necesidades del espacio, ya sea para tránsito peatonal, vehículos o ambientes decorativos.',
                    'en' => 'Floors and pavements are fundamental in any architectural space, as they must combine resistance, aesthetics and functionality. Self-leveling mortars and high-resistance pavements offer uniform and durable surfaces. For outdoors, anti-slip and waterproof pavements are essential to guarantee safety and protection against moisture. Construction solutions must adapt to space needs, whether for pedestrian traffic, vehicles or decorative environments.',
                    'fr' => 'Les sols et revêtements sont essentiels dans tout espace architectural : ils doivent concilier résistance, esthétique et fonctionnalité. Les mortiers autonivelants et les revêtements à haute résistance offrent des surfaces uniformes et durables. En extérieur, des revêtements antidérapants et étanches sont indispensables pour garantir la sécurité et la protection contre l’humidité. Les solutions doivent s’adapter aux besoins : circulation piétonne, véhicules ou environnements décoratifs.',
                ],
                'applications' => ['tiles', 'waterproofing'],
            ],

            [
                'slug' => 'kitchens',
                'title' => [
                    'es' => 'Cocinas exteriores',
                    'en' => 'Outdoor kitchens',
                    'fr' => 'Cuisines extérieures',
                ],
                'image' => '/spaces/images/cocinaexterior.jpg',
                'description' => [
                    'es' => 'Las cocinas exteriores están diseñadas para disfrutar de actividades culinarias al aire libre. Para su construcción se requieren materiales resistentes a la intemperie, como revestimientos cerámicos y pavimentos antideslizantes. Los morteros impermeabilizantes y las superficies fáciles de limpiar garantizan durabilidad y funcionalidad. El diseño puede integrar zonas de cocción, almacenamiento y comedor exterior, creando ambientes cómodos y estéticos para reuniones sociales.',
                    'en' => 'Outdoor kitchens are spaces designed to enjoy culinary activities outdoors. For their construction, weather-resistant materials are required, such as ceramic coatings and anti-slip pavements. Waterproof mortars and easy-to-clean surfaces guarantee their durability and functionality. The architectural design can integrate cooking areas, storage and outdoor dining areas, creating comfortable and aesthetic environments for social gatherings.',
                    'fr' => 'Les cuisines extérieures sont conçues pour profiter des activités culinaires en plein air. Leur construction requiert des matériaux résistants aux intempéries, tels que des revêtements céramiques et des sols antidérapants. Les mortiers d’étanchéité et les surfaces faciles à nettoyer garantissent durabilité et fonctionnalité. Le design peut intégrer zones de cuisson, rangements et coin repas extérieur, créant des espaces confortables et esthétiques pour les réunions.',
                ],
                'applications' => ['coatings', 'plasters', 'masonry', 'tiles', 'waterproofing'],
            ],

            [
                'slug' => 'pools',
                'title' => [
                    'es' => 'Piscinas',
                    'en' => 'Swimming pools',
                    'fr' => 'Piscines',
                ],
                'image' => '/spaces/images/piscina.jpg',
                'description' => [
                    'es' => 'Las piscinas requieren soluciones constructivas que garanticen impermeabilización, seguridad y estética. Los morteros específicos para piscina ofrecen excelente resistencia al agua y al cloro, protegiendo la estructura. Los revestimientos antideslizantes en suelos y coronación evitan accidentes, mientras que los acabados decorativos permiten crear ambientes elegantes y personalizados. La correcta aplicación de sistemas de impermeabilización y juntas asegura la durabilidad frente a la intemperie y el uso intensivo.',
                    'en' => 'Pools require construction solutions that guarantee waterproofing, safety and aesthetics. Specific pool mortars offer excellent resistance to water and chlorine, ensuring structure protection. Anti-slip coatings on floors and edges prevent accidents, while decorative finishes allow creating elegant and customized environments. The correct application of waterproofing systems and joints ensures pool durability against weather conditions and intensive use.',
                    'fr' => 'Les piscines nécessitent des solutions constructives garantissant étanchéité, sécurité et esthétique. Les mortiers spécifiques pour piscine offrent une excellente résistance à l’eau et au chlore, protégeant la structure. Les revêtements antidérapants sur les sols et les bords préviennent les accidents, tandis que les finitions décoratives permettent de créer des environnements élégants et personnalisés. Une application correcte des systèmes d’étanchéité et des joints assure une durabilité face aux intempéries et à l’usage intensif.',
                ],
                'applications' => ['coatings', 'masonry', 'tiles'],
            ],
        ];

        foreach ($spaces as $index => $row) {
            $slug = $row['slug'];

            $image = $this->normalizePublicUrl($row['image'] ?? null);

            // Texto plano (para SEO/alt/title)
            $titleEs = $row['title']['es'] ?? '';
            $titleEn = $row['title']['en'] ?? $titleEs;
            $titleFr = $row['title']['fr'] ?? $titleEs;

            // HTML (para UI)
            $titleHtmlEs = $this->wrapTitleHtml($titleEs);
            $titleHtmlEn = $this->wrapTitleHtml($titleEn);
            $titleHtmlFr = $this->wrapTitleHtml($titleFr);

            $descEs = $row['description']['es'] ?? '';
            $descEn = $row['description']['en'] ?? $descEs;
            $descFr = $row['description']['fr'] ?? $descEs;

            $descHtmlEs = $this->wrapDescHtml($descEs);
            $descHtmlEn = $this->wrapDescHtml($descEn);
            $descHtmlFr = $this->wrapDescHtml($descFr);

            $space = Space::updateOrCreate(
                ['slug' => $slug],
                [
                    'slug_en' => $row['slug_en'] ?? $slug,
                    'slug_fr' => $row['slug_fr'] ?? $slug,

                    // ✅ Guardamos HTML en columnas principales
                    'title'    => $titleHtmlEs,
                    'title_en' => $titleHtmlEn,
                    'title_fr' => $titleHtmlFr,

                    'description'    => $descHtmlEs,
                    'description_en' => $descHtmlEn,
                    'description_fr' => $descHtmlFr,

                    'image' => $image,

                    // ✅ Metadatos SIEMPRE plano
                    'image_title' => [
                        'es' => $titleEs,
                        'en' => $titleEn,
                        'fr' => $titleFr,
                    ],
                    'image_alt' => [
                        'es' => $titleEs,
                        'en' => $titleEn,
                        'fr' => $titleFr,
                    ],

                    'seo_title' => [
                        'es' => $titleEs,
                        'en' => $titleEn,
                        'fr' => $titleFr,
                    ],
                    'seo_description' => [
                        'es' => Str::limit(strip_tags($descEs), 160, ''),
                        'en' => Str::limit(strip_tags($descEn), 160, ''),
                        'fr' => Str::limit(strip_tags($descFr), 160, ''),
                    ],

                    'order' => $index + 1,
                    'is_active' => true,
                ]
            );

            // Relacionar aplicaciones (pivot order)
            $appSlugs = $row['applications'] ?? [];

            if (method_exists($space, 'applications')) {
                $sync = [];
                foreach (array_values($appSlugs) as $i => $appSlug) {
                    $app = $this->findApplicationByAnySlug($appSlug);
                    if (!$app) {
                        $this->warnMissingApp($slug, $appSlug);
                        continue;
                    }
                    $sync[$app->id] = ['order' => $i + 1];
                }
                $space->applications()->sync($sync);
            } elseif (method_exists($space, 'applicationLinks')) {
                $space->applicationLinks()->delete();

                foreach (array_values($appSlugs) as $i => $appSlug) {
                    $app = $this->findApplicationByAnySlug($appSlug);
                    if (!$app) {
                        $this->warnMissingApp($slug, $appSlug);
                        continue;
                    }
                    $space->applicationLinks()->create([
                        'application_id' => $app->id,
                        'order' => $i + 1,
                    ]);
                }
            }
        }
    }

    private function wrapTitleHtml(string $text): string
    {
        $text = e($text); // evita romper HTML si el título trae caracteres raros
        return '<h1 class="font-semibold sm:text-xl lg:text-4xl md:text-2xl">' . $text . '</h1>';
    }

    private function wrapDescHtml(string $text): string
    {
        // Aquí NO usamos e() si tus admins van a meter HTML dentro del párrafo.
        // Como ahora quieres SOLO texto dentro de <p>, sí conviene escapar:
        $text = e($text);
        return '<p class="text-base xl:text-lg md:text-sm">' . $text . '</p>';
    }

    private function findApplicationByAnySlug(string $slug): ?Application
    {
        $map = [
            'thermal' => 'thermalInsulation',
        ];
        $slug = $map[$slug] ?? $slug;

        return Application::query()
            ->where('slug', $slug)
            ->orWhere('slug_en', $slug)
            ->orWhere('slug_fr', $slug)
            ->first();
    }

    private function warnMissingApp(string $spaceSlug, string $appSlug): void
    {
        if ($this->command) {
            $this->command->warn("SpacesSeeder: falta Application (slug) '{$appSlug}' para Space '{$spaceSlug}'");
        }
    }

    private function normalizePublicUrl(?string $path): ?string
    {
        if (!$path) return null;
        return str_replace(' ', '%20', $path);
    }
}
