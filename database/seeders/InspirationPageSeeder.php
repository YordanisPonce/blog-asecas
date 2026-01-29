<?php

namespace Database\Seeders;

use App\Models\InspirationPage;
use Illuminate\Database\Seeder;

class InspirationPageSeeder extends Seeder
{
    public function run(): void
    {
        InspirationPage::updateOrCreate(
            ['id' => 1],
            [
                // TITLE (con HTML para que te llegue con estilos)
                'title_es' => '<h1 class="w-[36rem]">Casos reales que te ayudan a inspirarte</h1>',
                'title_en' => '<h1 class="w-[36rem]">Real cases to inspire you</h1>',
                'title_fr' => '<h1 class="w-[36rem]">Cas réels pour vous inspirer</h1>',

                // DESCRIPTION (también HTML)
                'description_es' => '<p class="mt-6 text-lg">Explora proyectos reales y acabados que muestran cómo se transforma una fachada y qué resultados puedes lograr.</p>',
                'description_en' => '<p class="mt-6 text-lg">Explore real projects and finishes that show how a facade is transformed and what results you can achieve.</p>',
                'description_fr' => '<p class="mt-6 text-lg">Découvrez des projets réels et des finitions qui montrent comment une façade se transforme et quels résultats vous pouvez obtenir.</p>',

                // SEO
                'seo_title_es' => 'Inspiración | Grupo Estucalia',
                'seo_title_en' => 'Inspiration | Grupo Estucalia',
                'seo_title_fr' => 'Inspiration | Grupo Estucalia',

                'seo_description_es' => 'Casos reales de fachadas y acabados para inspirarte en tu próximo proyecto.',
                'seo_description_en' => 'Real facade and finish cases to inspire your next project.',
                'seo_description_fr' => 'Des cas réels de façades et de finitions pour inspirer votre prochain projet.',

                // LIMIT por defecto (ej. 8 imágenes)
                'default_limit' => 8,
            ]
        );
    }
}
