<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * Mapeo: application_slug => [category_slugs...]
         * ⚠️ Ajusta estos slugs a los que tengas realmente en tu tabla categories.
         */
        $applicationToCategorySlugs = [
            // Revestimientos
            'coatings' => [
                'single-layer-mortar',
                'lime-mortar',
                'stamped-mortar',
                'decorative-stone-mortar',
                'bonding-bridge',
            ],

            // Revocos y enlucidos
            'plasters' => [
                'lime-mortar',
                'single-layer-mortar',
                'stamped-mortar',
                'decorative-stone-mortar',
                'bonding-bridge',
            ],

            // Albañilería
            'masonry' => [
                'single-layer-mortar',
                'tile-adhesive',
                'lime-mortar',
                'stamped-mortar',
                'water-protector',
                'bonding-bridge',
            ],

            // Baldosas
            'tiles' => [
                'tile-adhesive',
                'grout-mortar',
            ],

            // Aislamiento térmico
            'thermalInsulation' => [
                'single-layer-mortar',
                'tile-adhesive',
                'lime-mortar',
                'stamped-mortar',
                'bonding-bridge',
            ],

            // Impermeabilización
            'waterproofing' => [
                'single-layer-mortar',
                'lime-mortar',
                'stamped-mortar',
                'grout-mortar',
                'decorative-stone-mortar',
                'water-protector',
            ],

            // Deshumidificación
            'dehumidification' => [
                'single-layer-mortar',
                'tile-adhesive',
                'lime-mortar',
                'stamped-mortar',
            ],
        ];

        /**
         * Apps (con HTML listo para tu HeroSection).
         * image: si lo sirves desde el FRONT (Next public/img), déjalo como "/img/xxx.jpg".
         * icon: si lo sirves desde el BACK (storage/public), usa "applications/icons/xxx.svg".
         */
        $apps = [
            'coatings' => [
                'order' => 1,
                'image' => 'applications/images/revestimiento.jpg',
                'icon'  => 'applications/icons/coatings.svg',
                'names' => [
                    'es' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Revestimientos</h1>',
                    'en' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Coatings</h1>',
                    'fr' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Revêtements</h1>',
                ],
                'short' => [
                    'es' => 'Protección y decoración en una sola aplicación.',
                    'en' => 'Protection and decoration in a single application.',
                    'fr' => 'Protection et décoration en une seule application.',
                ],
                'descriptions' => [
                    'es' => '<p class="text-base xl:text-lg md:text-sm">El mortero monocapa es ideal para revestimientos de fachadas, ofreciendo protección y decoración en una sola aplicación. Su alta resistencia a las condiciones climáticas y la amplia variedad de acabados lo convierten en una opción versátil y duradera. Por otro lado, el mortero de cal es especialmente útil en edificaciones tradicionales o restauraciones, ya que permite una mayor transpiración de las paredes. Ambos tipos de morteros proporcionan una excelente adherencia y mejoran la estética del edificio, manteniendo la superficie bien protegida.</p>',
                    'en' => '<p class="text-base xl:text-lg md:text-sm">Single-layer mortar is ideal for facade coatings, offering protection and decoration in a single application. Its high resistance to weather conditions and wide variety of finishes make it a versatile and durable option. Lime mortar is especially useful in traditional buildings or restorations, as it improves wall breathability. Both solutions provide excellent adhesion and enhance the building’s aesthetics while keeping the surface well protected.</p>',
                    'fr' => '<p class="text-base xl:text-lg md:text-sm">Le mortier monocouche est idéal pour les revêtements de façade, offrant protection et décoration en une seule application. Sa résistance aux intempéries et la variété de finitions en font une solution durable. Le mortier à la chaux est particulièrement adapté aux bâtiments traditionnels ou aux restaurations, car il améliore la respirabilité des murs. Les deux assurent une excellente adhérence et valorisent l’esthétique tout en protégeant les surfaces.</p>',
                ],
            ],

            'plasters' => [
                'order' => 2,
                'image' => 'applications/images/revocos_enlucidos.jpg',
                'icon'  => 'applications/icons/plasters.svg',
                'names' => [
                    'es' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Revocos y enlucidos</h1>',
                    'en' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Plasters & Renders</h1>',
                    'fr' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Enduits et plâtres</h1>',
                ],
                'short' => [
                    'es' => 'Transpirabilidad, flexibilidad y acabado uniforme.',
                    'en' => 'Breathability, flexibility and a smooth finish.',
                    'fr' => 'Respirabilité, flexibilité et finition uniforme.',
                ],
                'descriptions' => [
                    'es' => '<p class="text-base xl:text-lg md:text-sm">Para revocos y enlucidos, el mortero de cal es una opción tradicional que ofrece gran transpirabilidad y flexibilidad, ideal para evitar fisuras en superficies antiguas. En aplicaciones modernas, el mortero monocapa destaca por su doble función de nivelar y proporcionar un acabado decorativo en una sola capa, ahorrando tiempo y costes. Ambos garantizan buena adherencia y resistencia frente a la intemperie.</p>',
                    'en' => '<p class="text-base xl:text-lg md:text-sm">For plasters and renders, lime mortar is a traditional choice that provides excellent breathability and flexibility, helping prevent cracks on older substrates. In modern applications, single-layer mortar levels and delivers a decorative finish in one coat, saving time and cost. Both options offer strong adhesion and weather resistance.</p>',
                    'fr' => '<p class="text-base xl:text-lg md:text-sm">Pour les enduits, le mortier à la chaux apporte respirabilité et flexibilité, limitant les fissures sur supports anciens. En usage moderne, le mortier monocouche nivelle et offre une finition décorative en une seule passe, optimisant temps et coûts. Les deux solutions assurent une bonne adhérence et une résistance aux intempéries.</p>',
                ],
            ],

            'masonry' => [
                'order' => 3,
                'image' => 'applications/images/albañileria.jpg',
                'icon'  => 'applications/icons/masonry.svg',
                'names' => [
                    'es' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Albañilería</h1>',
                    'en' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Masonry</h1>',
                    'fr' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Maçonnerie</h1>',
                ],
                'short' => [
                    'es' => 'Fijación sólida y durabilidad en obra y reparaciones.',
                    'en' => 'Solid bonding and durability for building and repairs.',
                    'fr' => 'Fixation solide et durabilité pour la construction et la réparation.',
                ],
                'descriptions' => [
                    'es' => '<p class="text-base xl:text-lg md:text-sm">En trabajos de albañilería, los morteros aportan resistencia y estabilidad en uniones, reparaciones y revestimientos. El mortero cola facilita la colocación de piezas en muros y suelos, mientras que el monocapa protege y decora en exteriores. En obra tradicional, el mortero de cal ofrece flexibilidad y buena gestión de la humedad. Para soportes difíciles, el puente de unión mejora la adherencia, y los protectores ayudan a prolongar la vida útil del acabado.</p>',
                    'en' => '<p class="text-base xl:text-lg md:text-sm">For masonry work, mortars provide strength and stability for joints, repairs, and exterior finishes. Tile adhesive supports reliable placement on walls and floors, while single-layer mortar protects and decorates facades. In traditional projects, lime mortar adds flexibility and helps manage moisture. On challenging substrates, bonding bridges improve adhesion, and water protectors help extend the lifespan of the finish.</p>',
                    'fr' => '<p class="text-base xl:text-lg md:text-sm">En maçonnerie, les mortiers assurent résistance et stabilité pour les assemblages, réparations et finitions extérieures. La colle à carrelage permet une pose fiable sur murs et sols, tandis que le monocouche protège et décore les façades. En rénovation traditionnelle, la chaux apporte souplesse et gestion de l’humidité. Sur supports difficiles, un pont d’adhérence améliore l’accroche, et les protecteurs d’eau prolongent la durabilité.</p>',
                ],
            ],

            'tiles' => [
                'order' => 4,
                'image' => 'applications/images/baldosas.jpg',
                'icon'  => 'applications/icons/tiles.svg',
                'names' => [
                    'es' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Baldosas</h1>',
                    'en' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Tiles</h1>',
                    'fr' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Carrelage</h1>',
                ],
                'short' => [
                    'es' => 'Adherencia, resistencia y juntas uniformes.',
                    'en' => 'Adhesion, resistance and clean joints.',
                    'fr' => 'Adhérence, résistance et joints nets.',
                ],
                'descriptions' => [
                    'es' => '<p class="text-base xl:text-lg md:text-sm">El mortero cola es el más adecuado para la instalación de baldosas en paredes y suelos, tanto en interiores como en exteriores. Ofrece una alta adherencia y resistencia, incluso en zonas húmedas o con cambios de temperatura. Para el remate, el mortero de juntas asegura un sellado uniforme, durable y estético.</p>',
                    'en' => '<p class="text-base xl:text-lg md:text-sm">Tile adhesive mortar is ideal for installing tiles on walls and floors, indoors or outdoors. It delivers strong adhesion and resistance, even in humid areas or under temperature changes. For the final finish, grout mortar provides an even, durable and clean joint seal.</p>',
                    'fr' => '<p class="text-base xl:text-lg md:text-sm">Le mortier-colle convient parfaitement à la pose de carreaux sur murs et sols, en intérieur comme en extérieur. Il offre une excellente adhérence et une bonne résistance, même en zones humides ou soumises à des variations de température. Pour la finition, le mortier de jointoiement assure un joint régulier, durable et esthétique.</p>',
                ],
            ],

            'thermalInsulation' => [
                'order' => 5,
                'image' => 'applications/images/aislamiento.jpg',
                'icon'  => 'applications/icons/thermal-insulation.svg',
                'names' => [
                    'es' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Aislamiento térmico</h1>',
                    'en' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Thermal Insulation</h1>',
                    'fr' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Isolation thermique</h1>',
                ],
                'short' => [
                    'es' => 'Confort térmico y protección del sistema.',
                    'en' => 'Thermal comfort and system protection.',
                    'fr' => 'Confort thermique et protection du système.',
                ],
                'descriptions' => [
                    'es' => '<p class="text-base xl:text-lg md:text-sm">En sistemas de aislamiento (como SATE), el mortero monocapa puede actuar como capa protectora y decorativa. Si buscas una solución más natural y transpirable, el mortero de cal ayuda a regular la humedad y mejorar el confort térmico. En soportes poco absorbentes, el puente de unión mejora la adherencia del sistema y su durabilidad.</p>',
                    'en' => '<p class="text-base xl:text-lg md:text-sm">In insulation systems (such as ETICS), single-layer mortar can provide a protective and decorative coat. If you prefer a more natural and breathable solution, lime mortar helps regulate moisture and improve indoor comfort. On low-absorption substrates, bonding bridges enhance adhesion and long-term performance.</p>',
                    'fr' => '<p class="text-base xl:text-lg md:text-sm">Dans les systèmes d’isolation (type ITE/ETICS), le mortier monocouche peut constituer une couche de protection et de finition. Pour une solution plus naturelle et respirante, le mortier à la chaux aide à réguler l’humidité et à améliorer le confort. Sur supports peu absorbants, un pont d’adhérence renforce l’accroche et la durabilité du système.</p>',
                ],
            ],

            'waterproofing' => [
                'order' => 6,
                'image' => 'applications/images/impermeabilizacion.jpg',
                'icon'  => 'applications/icons/waterproofing.svg',
                'names' => [
                    'es' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Impermeabilización</h1>',
                    'en' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Waterproofing</h1>',
                    'fr' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Imperméabilisation</h1>',
                ],
                'short' => [
                    'es' => 'Protección frente a la humedad y el agua de lluvia.',
                    'en' => 'Protection against moisture and rainwater.',
                    'fr' => 'Protection contre l’humidité et l’eau de pluie.',
                ],
                'descriptions' => [
                    'es' => '<p class="text-base xl:text-lg md:text-sm">Para impermeabilizar fachadas y paramentos, el mortero monocapa crea una barrera resistente al agua sin renunciar a un acabado estético. En zonas con juntas visibles, el mortero de juntas aporta un sellado uniforme. En acabados decorativos, los sistemas de piedra y mortero impreso combinan estética y protección. Para reforzar la defensa frente al agua, los protectores o resinas de acabado ayudan a prolongar la vida útil del revestimiento.</p>',
                    'en' => '<p class="text-base xl:text-lg md:text-sm">For waterproofing facades and walls, single-layer mortar creates a strong water-resistant barrier while maintaining an attractive finish. Where joints are exposed, grout mortar provides an even seal. Decorative options such as stone finishes and stamped mortar combine aesthetics and protection. To further enhance water resistance, water protectors or finishing resins can extend the lifespan of the coating.</p>',
                    'fr' => '<p class="text-base xl:text-lg md:text-sm">Pour imperméabiliser façades et parois, le mortier monocouche forme une barrière résistante à l’eau tout en offrant une finition esthétique. Lorsque les joints sont visibles, le mortier de jointoiement assure une étanchéité homogène. Les finitions décoratives, comme la pierre ou le mortier imprimé, allient protection et design. Pour renforcer la résistance à l’eau, des protecteurs ou résines de finition prolongent la durabilité du revêtement.</p>',
                ],
            ],

            'dehumidification' => [
                'order' => 7,
                'image' => 'applications/images/deshumificacion.jpg',
                'icon'  => 'applications/icons/dehumidification.svg',
                'names' => [
                    'es' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Deshumidificación</h1>',
                    'en' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Dehumidification</h1>',
                    'fr' => '<h1 class="font-semibold sm:text-xl   lg:text-4xl md:text-2xl">Déshumidification</h1>',
                ],
                'short' => [
                    'es' => 'Ayuda a gestionar la humedad y proteger paramentos.',
                    'en' => 'Helps manage moisture and protect surfaces.',
                    'fr' => 'Aide à gérer l’humidité et à protéger les supports.',
                ],
                'descriptions' => [
                    'es' => '<p class="text-base xl:text-lg md:text-sm">En proyectos con problemas de humedad, el mortero de cal es muy recomendable por su transpirabilidad y su capacidad de ayudar a regular el vapor de agua en el soporte. El monocapa contribuye a proteger el paramento frente a la intemperie, y los acabados decorativos como piedra o impreso aportan durabilidad sin renunciar al diseño. En soportes complejos, el puente de unión mejora la adherencia y el rendimiento del sistema.</p>',
                    'en' => '<p class="text-base xl:text-lg md:text-sm">For moisture-related projects, lime mortar is highly recommended due to its breathability and its ability to help regulate water vapor within the substrate. Single-layer mortar protects surfaces from weather exposure, while decorative finishes such as stone or stamped mortar add durability without compromising design. On difficult substrates, bonding bridges improve adhesion and overall system performance.</p>',
                    'fr' => '<p class="text-base xl:text-lg md:text-sm">Pour les projets avec humidité, le mortier à la chaux est recommandé grâce à sa respirabilité et à sa capacité à aider à réguler la vapeur d’eau dans le support. Le monocouche protège le parement des agressions extérieures, tandis que les finitions décoratives (pierre, imprimé) apportent durabilité et esthétique. Sur supports difficiles, un pont d’adhérence améliore l’accroche et les performances du système.</p>',
                ],
            ],
        ];

        foreach ($apps as $slug => $data) {
            $payload = [
                'slug' => $slug,
                'slug_en' => $slug,
                'slug_fr' => $slug,

                'name' => $data['names']['es'],
                'name_en' => $data['names']['en'],
                'name_fr' => $data['names']['fr'],

                'icon' => $data['icon'] ?? null,
                'image' => $data['image'] ?? null,

                'image_alt' => [
                    'es' => $data['names']['es'],
                    'en' => $data['names']['en'],
                    'fr' => $data['names']['fr'],
                ],
                'image_title' => [
                    'es' => $data['names']['es'],
                    'en' => $data['names']['en'],
                    'fr' => $data['names']['fr'],
                ],

                'short_description_es' => $data['short']['es'] ?? null,
                'short_description_en' => $data['short']['en'] ?? null,
                'short_description_fr' => $data['short']['fr'] ?? null,

                'description_es' => $data['descriptions']['es'] ?? null,
                'description_en' => $data['descriptions']['en'] ?? null,
                'description_fr' => $data['descriptions']['fr'] ?? null,

                'order' => $data['order'] ?? 0,
                'is_active' => true,
            ];

            $app = Application::updateOrCreate(['slug' => $slug], $payload);

            // Sync categorías (pivot order fijo)
            $slugs = $applicationToCategorySlugs[$slug] ?? [];

            if (empty($slugs)) {
                $app->categories()->sync([]);
                continue;
            }

            $cats = Category::whereIn('slug', $slugs)->get(['id', 'slug'])->keyBy('slug');

            $sync = [];
            $missing = [];

            foreach ($slugs as $i => $catSlug) {
                if (!isset($cats[$catSlug])) {
                    $missing[] = $catSlug;
                    continue;
                }
                $sync[$cats[$catSlug]->id] = ['order' => $i + 1];
            }

            $app->categories()->sync($sync);

            // Aviso si faltan categorías
            if (!empty($missing) && $this->command) {
                $this->command->warn("ApplicationSeeder: faltan categories.slug para '{$slug}': " . implode(', ', $missing));
            }
        }
    }
}
