<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FooterPage;

class FooterPageSeeder extends Seeder
{
    public function run(): void
    {
        FooterPage::updateOrCreate(
            ['id' => 1],
            [
                // Logo (si lo subes por Filament luego, se sobreescribe)
                // Puedes dejar null y subirlo en admin.
                'logo' => null,

                // TITLES
                'legal_title_es' => 'TEXTOS JURÍDICOS',
                'legal_title_en' => 'LEGAL TEXTS',
                'legal_title_fr' => 'TEXTES JURIDIQUES',

                'company_title_es' => 'EMPRESA',
                'company_title_en' => 'COMPANY',
                'company_title_fr' => 'ENTREPRISE',

                'products_title_es' => 'PRODUCTOS',
                'products_title_en' => 'PRODUCTS',
                'products_title_fr' => 'PRODUITS',

                'contact_title_es' => 'CONTACTO',
                'contact_title_en' => 'CONTACT',
                'contact_title_fr' => 'CONTACT',

                'follow_title_es' => 'SÍGUENOS',
                'follow_title_en' => 'FOLLOW US',
                'follow_title_fr' => 'SUIVEZ-NOUS',

                // LINKS (HTML permitido en label_html)
                'legal_links_es' => [
                    ['label_html' => 'Aviso legal', 'url' => '/aviso-legal'],
                    ['label_html' => 'Política de privacidad', 'url' => '/politica-privacidad'],
                    ['label_html' => 'Política de cookies', 'url' => '/politica-cookies'],
                ],
                'legal_links_en' => [
                    ['label_html' => 'Legal notice', 'url' => '/aviso-legal'],
                    ['label_html' => 'Privacy policy', 'url' => '/politica-privacidad'],
                    ['label_html' => 'Cookie policy', 'url' => '/politica-cookies'],
                ],
                'legal_links_fr' => [
                    ['label_html' => 'Mentions légales', 'url' => '/aviso-legal'],
                    ['label_html' => 'Politique de confidentialité', 'url' => '/politica-privacidad'],
                    ['label_html' => 'Politique de cookies', 'url' => '/politica-cookies'],
                ],

                'company_links_es' => [
                    ['label_html' => 'Sobre nosotros', 'url' => '/empresa'],
                    ['label_html' => 'Trabaja con nosotros', 'url' => '/trabaja-con-nosotros'],
                    ['label_html' => 'Blog', 'url' => '/blog'],
                    ['label_html' => 'Contacto', 'url' => '/contacto'],
                ],
                'company_links_en' => [
                    ['label_html' => 'About us', 'url' => '/empresa'],
                    ['label_html' => 'Work with us', 'url' => '/trabaja-con-nosotros'],
                    ['label_html' => 'Blog', 'url' => '/blog'],
                    ['label_html' => 'Contact', 'url' => '/contacto'],
                ],
                'company_links_fr' => [
                    ['label_html' => 'À propos de nous', 'url' => '/empresa'],
                    ['label_html' => 'Travailler avec nous', 'url' => '/trabaja-con-nosotros'],
                    ['label_html' => 'Blog', 'url' => '/blog'],
                    ['label_html' => 'Contact', 'url' => '/contacto'],
                ],

                'products_links_es' => [
                    ['label_html' => 'Mortero monocapa', 'url' => '/categories/single-layer-mortar'],
                    ['label_html' => 'Mortero cola', 'url' => '/categories/tile-adhesive'],
                    ['label_html' => 'Mortero de cal', 'url' => '/categories/lime-mortar'],
                    ['label_html' => 'Mortero polivalente para juntas', 'url' => '/categories/grout-mortar'],
                    ['label_html' => 'Mortero impreso vertical', 'url' => '/categories/stamped-mortar'],
                    ['label_html' => 'Protector de agua', 'url' => '/categories/water-protector'],
                    ['label_html' => 'Mortero de reparación', 'url' => '/categories/bonding-bridge'],
                ],
                'products_links_en' => [
                    ['label_html' => 'Monocoat mortar', 'url' => '/categories/single-layer-mortar'],
                    ['label_html' => 'Tile adhesive', 'url' => '/categories/tile-adhesive'],
                    ['label_html' => 'Lime mortar', 'url' => '/categories/lime-mortar'],
                    ['label_html' => 'All-purpose joint mortar', 'url' => '/categories/grout-mortar'],
                    ['label_html' => 'Vertical printed mortar', 'url' => '/categories/stamped-mortar'],
                    ['label_html' => 'Water protector', 'url' => '/categories/water-protector'],
                    ['label_html' => 'Repair mortar', 'url' => '/categories/bonding-bridge'],
                ],
                'products_links_fr' => [
                    ['label_html' => 'Mortier monocouche', 'url' => '/categories/single-layer-mortar'],
                    ['label_html' => 'Mortier colle', 'url' => '/categories/tile-adhesive'],
                    ['label_html' => 'Mortier de chaux', 'url' => '/categories/lime-mortar'],
                    ['label_html' => 'Mortier polyvalent pour joints', 'url' => '/categories/grout-mortar'],
                    ['label_html' => 'Mortier imprimé vertical', 'url' => '/categories/stamped-mortar'],
                    ['label_html' => "Protecteur d'eau", 'url' => '/categories/water-protector'],
                    ['label_html' => 'Mortier de réparation', 'url' => '/categories/bonding-bridge'],
                ],

                // CONTACT
                'contact_address_html_es' => "Cno Viejo de Fortuna, 40 Matanzas<br/>30148, Santomera, Murcia (ESPAÑA).",
                'contact_address_html_en' => "Cno Viejo de Fortuna, 40 Matanzas<br/>30148, Santomera, Murcia (SPAIN).",
                'contact_address_html_fr' => "Cno Viejo de Fortuna, 40 Matanzas<br/>30148, Santomera, Murcie (ESPAGNE).",

                'contact_phone_1' => '+34 968 862 467',
                'contact_phone_2' => '+34 663 519 854',
                'contact_email'   => 'grupoestucalia@grupoestucalia.com',

                // SOCIAL
                'social_links_es' => [
                    ['icon_key' => 'linkedin', 'label_html' => 'LinkedIn', 'url' => 'https://www.linkedin.com/'],
                    ['icon_key' => 'facebook', 'label_html' => 'Facebook', 'url' => 'https://www.facebook.com/'],
                    ['icon_key' => 'instagram', 'label_html' => 'Instagram', 'url' => 'https://www.instagram.com/'],
                    ['icon_key' => 'youtube', 'label_html' => 'YouTube', 'url' => 'https://www.youtube.com/'],
                ],
                'social_links_en' => [
                    ['icon_key' => 'linkedin', 'label_html' => 'LinkedIn', 'url' => 'https://www.linkedin.com/'],
                    ['icon_key' => 'facebook', 'label_html' => 'Facebook', 'url' => 'https://www.facebook.com/'],
                    ['icon_key' => 'instagram', 'label_html' => 'Instagram', 'url' => 'https://www.instagram.com/'],
                    ['icon_key' => 'youtube', 'label_html' => 'YouTube', 'url' => 'https://www.youtube.com/'],
                ],
                'social_links_fr' => [
                    ['icon_key' => 'linkedin', 'label_html' => 'LinkedIn', 'url' => 'https://www.linkedin.com/'],
                    ['icon_key' => 'facebook', 'label_html' => 'Facebook', 'url' => 'https://www.facebook.com/'],
                    ['icon_key' => 'instagram', 'label_html' => 'Instagram', 'url' => 'https://www.instagram.com/'],
                    ['icon_key' => 'youtube', 'label_html' => 'YouTube', 'url' => 'https://www.youtube.com/'],
                ],

                // COPYRIGHT
                'copyright_text_es' => 'Copyright©2025',
                'copyright_text_en' => 'Copyright©2025',
                'copyright_text_fr' => 'Copyright©2025',
            ]
        );
    }
}
