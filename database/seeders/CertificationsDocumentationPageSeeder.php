<?php

namespace Database\Seeders;

use App\Models\CertificationsDocumentationPage;
use Illuminate\Database\Seeder;

class CertificationsDocumentationPageSeeder extends Seeder
{
    public function run(): void
    {
        CertificationsDocumentationPage::query()->updateOrCreate(
            ['id' => 1],
            [
                // ✅ Title con HTML (para render con dangerouslySetInnerHTML en front)
                'title_es' => '<h1 class="w-96">Certificaciones y documentación</h1>',
                'title_en' => '<h1 class="w-96">Certifications and documentation</h1>',
                'title_fr' => '<h1 class="w-96">Certifications et documentation</h1>',

                // ✅ PDFs en public/files/...
                'documents' => [
                    [
                        'key' => 'declaracion-conformidad-morteros-monocapa',
                        'title_es' => 'Declaración conformidad morteros monocapa',
                        'title_en' => 'Declaration of conformity – monocapa mortars',
                        'title_fr' => 'Déclaration de conformité – mortiers monocouche',
                        'file_path' => 'files/documents/certifications/declaracion-morteros-monocapa.pdf',
                    ],
                    [
                        'key' => 'declaracion-conformidad-cementos-cola',
                        'title_es' => 'Declaración conformidad cementos cola',
                        'title_en' => 'Declaration of conformity – tile adhesives',
                        'title_fr' => 'Déclaration de conformité – colles',
                        'file_path' => 'files/documents/certifications/declaracion-cementos-cola.pdf',
                    ],
                    [
                        'key' => 'documento-idoneidad-tecnica-plus',
                        'title_es' => 'Documento de Idoneidad Técnica Plus',
                        'title_en' => 'Technical suitability document Plus',
                        'title_fr' => 'Document d’aptitude technique Plus',
                        'file_path' => 'files/documents/certifications/idoneidad-tecnica-plus.pdf',
                    ],
                    [
                        'key' => 'certificado-aenor',
                        'title_es' => 'Certificado AENOR',
                        'title_en' => 'AENOR certificate',
                        'title_fr' => 'Certificat AENOR',
                        'file_path' => 'files/documents/certifications/aenor.pdf',
                    ],
                    [
                        'key' => 'certificado-iqnet',
                        'title_es' => 'Certificado IQNET',
                        'title_en' => 'IQNET certificate',
                        'title_fr' => 'Certificat IQNET',
                        'file_path' => 'files/documents/certifications/iqnet.pdf',
                    ],
                    [
                        'key' => 'politica-de-calidad',
                        'title_es' => 'Política de Calidad',
                        'title_en' => 'Quality policy',
                        'title_fr' => 'Politique qualité',
                        'file_path' => 'files/documents/certifications/politica-calidad.pdf',
                    ],
                ],

                'solutions_title_es' => 'Soluciones para la construcción',
                'solutions_title_en' => 'Solutions for construction',
                'solutions_title_fr' => 'Solutions pour la construction',

                'solutions_description_es' => 'Gracias a sus más de 25 años de experiencia Grupo Estucalia ofrece una gama de productos con una calidad excepcional.',
                'solutions_description_en' => 'With more than 25 years of experience, Grupo Estucalia offers a range of products with exceptional quality.',
                'solutions_description_fr' => 'Avec plus de 25 ans d’expérience, Grupo Estucalia propose une gamme de produits d’une qualité exceptionnelle.',

                // ✅ OJO: estos son SLUGS (por eso el controller debe buscar por slug)
                'featured_categories' => [
                    'single-layer-mortar',
                    'tile-adhesive',
                    'lime-mortar',
                    'grout-mortar',
                    'stamped-mortar',
                    'decorative-stone-mortar',
                    'water-protector',
                    'bonding-bridge',
                    'talisman-tools',
                ],

                'seo_title_es' => 'Certificaciones y documentación',
                'seo_title_en' => 'Certifications and documentation',
                'seo_title_fr' => 'Certifications et documentation',

                'seo_description_es' => 'Descarga certificaciones y documentación oficial.',
                'seo_description_en' => 'Download official certifications and documentation.',
                'seo_description_fr' => 'Téléchargez les certifications et la documentation officielles.',
            ]
        );
    }
}
