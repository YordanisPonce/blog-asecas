<?php

namespace Database\Seeders;

use App\Models\LegalPage;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LegalPageSeeder extends Seeder
{
    public function run(): void
    {
        $pageTitleEs = <<<'HTML'
<h1 class="text-3xl md:text-4xl font-bold text-center py-10 text-gray-900 mb-20">Aviso legal</h1>
HTML;

        $identInfoEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Datos identificativos</h2>

<p class="text-gray-700 mb-4">
De conformidad con lo establecido en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo de 27 de abril de 2016 relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos y por el que se deroga la Directiva 95/46/CE (Reglamento General de Protección de Datos) y en la Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y garantía de los derechos digitales, así como con la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y del Comercio Electrónico, se informa que este sitio web es propiedad de:
</p>

<p class="text-gray-700 mb-4">
<strong>ESTUCALIA MORTEROS, S.L. — GRUPO ESTUCALIA</strong><br/>
<strong>NIF:</strong> B30498257<br/>
<strong>Dirección:</strong> Camino Viejo de Fortuna, 40 – Matanzas, 30148 – Santomera (Murcia)<br/>
<strong>Correo electrónico:</strong> grupoestucalia@grupoestucalia.com
</p>

<p class="text-gray-700 mb-4">
El contenido de esta web tiene por objeto informar de sus productos y/o servicios.
</p>
HTML;

        $termsUseEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Condiciones generales de uso</h2>

<p class="text-gray-700 mb-4">
El acceso a este sitio web exige la aceptación de las condiciones generales de uso que en cada momento se encuentren vigentes en esta web. El usuario se compromete a utilizar el sitio web y sus contenidos sin contravenir la legislación vigente, la buena fe y el orden público.
</p>

<p class="text-gray-700 mb-4">
Queda prohibido el uso de la web, con fines ilícitos o lesivos, o que, de cualquier forma, puedan causar perjuicio o impidan el normal funcionamiento del sitio web.
</p>

<p class="text-gray-700 mb-4">
Respecto de los contenidos de esta web, se prohíbe su reproducción, distribución o modificación, total o parcial, a menos que se cuente con la autorización del titular de este sitio web.
</p>
HTML;

        $securityMeasuresEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Medidas de seguridad</h2>

<p class="text-gray-700 mb-4">
El usuario garantiza la autenticidad y veracidad de todos aquellos datos que comunique en los formularios de contacto, siendo suya la responsabilidad de actualizar la información suministrada, de tal forma que refleje su situación real. El usuario será responsable de la inexactitud o falta de veracidad de la información aportada.
</p>

<p class="text-gray-700 mb-4">
Los datos personales comunicados por el usuario al titular de este sitio web pueden ser almacenados en bases de datos automatizadas o no, cuya titularidad corresponde en exclusiva al titular, asumiendo éste todas las medidas de índole técnica, organizativa y de seguridad que garantizan la confidencialidad, integridad y calidad de la información contenida en las mismas de acuerdo con lo establecido en la normativa vigente en protección de datos. No obstante, el usuario debe ser consciente de que las medidas de seguridad de los sistemas informáticos en Internet no son enteramente fiables y que, por tanto, el responsable no puede garantizar la inexistencia de malware u otros elementos que puedan producir alteraciones en los sistemas informáticos del usuario o en sus documentos electrónicos y ficheros contenidos en los mismos aunque se pongan todos los medios necesarios para evitar la presencia de estos elementos dañinos.
</p>
HTML;

        $ipRightsEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Derechos de propiedad intelectual</h2>

<p class="text-gray-700 mb-4">
El usuario se obliga a respetar los derechos de propiedad intelectual de este responsable. El uso o la concesión de acceso a este sitio web no comportan el otorgamiento de derecho alguno sobre las marcas, nombres comerciales o cualquier otro signo distintivo que se utilicen en la misma.
</p>

<p class="text-gray-700 mb-4">
Respecto de los contenidos de esta web, se prohíbe su reproducción, distribución o modificación, total o parcial, a menos que se cuente con la autorización del titular de este sitio web.
</p>

<p class="text-gray-700 mb-4">
Quedan prohibidas las descargas de este sitio web para fines comerciales, por lo que el usuario no podrá explotar, reproducir, distribuir, modificar, comunicar públicamente, ceder, transformar o usar el contenido de este sitio web con fines comerciales. Asimismo, en virtud de lo establecido en este Aviso Legal, queda prohibida la reproducción total o parcial de los contenidos de este sitio web sin autorización expresa del autor y sin que puedan entenderse cedidos al usuario por el acceso a la misma.
</p>
HTML;

        $warrantyExclusionEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Exclusión de garantías y responsabilidad</h2>

<p class="text-gray-700 mb-4">
El responsable de esta web no otorga ninguna garantía ni se hace responsable, en ningún caso, de los daños y perjuicios de cualquier naturaleza derivados de:
</p>

<ul class="list-disc pl-6 text-gray-700 mb-4 space-y-2">
  <li>La falta de disponibilidad, mantenimiento y efectivo funcionamiento de la web, o de sus servicios y contenidos.</li>
  <li>La existencia de malware, programas maliciosos o lesivos en los contenidos.</li>
  <li>El uso ilícito, negligente, fraudulento o contrario a este Aviso Legal.</li>
</ul>
HTML;

        $modificationsEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Modificaciones</h2>

<p class="text-gray-700 mb-4">
El responsable de esta web se reserva el derecho de efectuar sin previo aviso las modificaciones que considere oportunas en su página web, pudiendo cambiar, suprimir o añadir tanto los contenidos y servicios que se presten a través de la misma, como la forma en la que éstos aparezcan presentados o localizados en su página web.
</p>
HTML;

        $applicableLawEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Ley aplicable y jurisdicción</h2>

<p class="text-gray-700 mb-4">
Estas Condiciones Generales de Uso del sitio web se encuentran sometidas a la legislación y jurisdicción españolas y a los tribunales que por ley correspondan.
</p>
HTML;

        // EN (puedes ajustar el texto legal si quieres)
        $pageTitleEn = <<<'HTML'
<h1 class="text-3xl md:text-4xl font-bold text-center py-10 text-gray-900 mb-20">Legal Notice</h1>
HTML;

        $identInfoEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Identifying information</h2>
<p class="text-gray-700 mb-4">
In accordance with Regulation (EU) 2016/679 (GDPR) and Spanish Organic Law 3/2018, as well as Law 34/2002 on Information Society Services and Electronic Commerce, this website is owned by:
</p>
<p class="text-gray-700 mb-4">
<strong>ESTUCALIA MORTEROS, S.L. — GRUPO ESTUCALIA</strong><br/>
<strong>Tax ID:</strong> B30498257<br/>
<strong>Address:</strong> Camino Viejo de Fortuna, 40 – Matanzas, 30148 – Santomera (Murcia)<br/>
<strong>Email:</strong> grupoestucalia@grupoestucalia.com
</p>
<p class="text-gray-700 mb-4">
The purpose of this website is to provide information about its products and/or services.
</p>
HTML;

        $termsUseEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">General terms of use</h2>
<p class="text-gray-700 mb-4">
Access to this website implies acceptance of the terms in force at any given time. Users agree to use the website and its contents in compliance with applicable law, good faith, and public order.
</p>
<p class="text-gray-700 mb-4">
Any unlawful or harmful use, or any use that may damage or hinder normal operation of the website, is prohibited.
</p>
<p class="text-gray-700 mb-4">
Reproduction, distribution, or modification of contents, in whole or in part, is prohibited unless expressly authorized by the website owner.
</p>
HTML;

        $securityMeasuresEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Security measures</h2>
<p class="text-gray-700 mb-4">
Users guarantee the authenticity and accuracy of any data provided through contact forms and are responsible for keeping such information up to date. Users are responsible for any inaccurate or false information provided.
</p>
<p class="text-gray-700 mb-4">
Personal data may be stored in automated or non-automated databases owned exclusively by the website owner, who applies technical, organizational, and security measures to ensure confidentiality, integrity, and quality. However, users should be aware that online security measures are not entirely reliable and the absence of malware or harmful elements cannot be fully guaranteed, even if reasonable measures are taken.
</p>
HTML;

        $ipRightsEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Intellectual property rights</h2>
<p class="text-gray-700 mb-4">
Users must respect the intellectual property rights of the website owner. Access to this website does not grant any rights over trademarks, trade names, or other distinctive signs used on it.
</p>
<p class="text-gray-700 mb-4">
Reproduction, distribution, or modification of the contents, in whole or in part, is prohibited unless expressly authorized by the website owner.
</p>
<p class="text-gray-700 mb-4">
Downloads for commercial purposes are prohibited. Users may not exploit, reproduce, distribute, modify, publicly communicate, transfer, transform, or use the contents for commercial purposes without express authorization.
</p>
HTML;

        $warrantyExclusionEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Exclusion of warranties and liability</h2>
<p class="text-gray-700 mb-4">
The website owner provides no warranties and shall not be liable for damages arising from:
</p>
<ul class="list-disc pl-6 text-gray-700 mb-4 space-y-2">
  <li>Lack of availability, maintenance, or effective operation of the website, services, or contents.</li>
  <li>Presence of malware or harmful programs in the contents.</li>
  <li>Unlawful, negligent, fraudulent, or improper use of the website.</li>
</ul>
HTML;

        $modificationsEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Modifications</h2>
<p class="text-gray-700 mb-4">
The website owner reserves the right to modify this website at any time without prior notice, including changing, removing, or adding contents and services, as well as their presentation.
</p>
HTML;

        $applicableLawEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Applicable law and jurisdiction</h2>
<p class="text-gray-700 mb-4">
These terms are governed by Spanish law and subject to the courts with jurisdiction as established by law.
</p>
HTML;

        // FR (puedes ajustar el texto legal si quieres)
        $pageTitleFr = <<<'HTML'
<h1 class="text-3xl md:text-4xl font-bold text-center py-10 text-gray-900 mb-20">Mentions légales</h1>
HTML;

        $identInfoFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Données d’identification</h2>
<p class="text-gray-700 mb-4">
Conformément au Règlement (UE) 2016/679 (RGPD) et à la Loi organique espagnole 3/2018, ainsi qu’à la Loi 34/2002 sur les services de la société de l’information et le commerce électronique, ce site web appartient à :
</p>
<p class="text-gray-700 mb-4">
<strong>ESTUCALIA MORTEROS, S.L. — GRUPO ESTUCALIA</strong><br/>
<strong>NIF :</strong> B30498257<br/>
<strong>Adresse :</strong> Camino Viejo de Fortuna, 40 – Matanzas, 30148 – Santomera (Murcia)<br/>
<strong>Email :</strong> grupoestucalia@grupoestucalia.com
</p>
<p class="text-gray-700 mb-4">
Le contenu de ce site a pour objet d’informer sur ses produits et/ou services.
</p>
HTML;

        $termsUseFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Conditions générales d’utilisation</h2>
<p class="text-gray-700 mb-4">
L’accès à ce site implique l’acceptation des conditions en vigueur. L’utilisateur s’engage à utiliser le site et son contenu conformément à la législation, à la bonne foi et à l’ordre public.
</p>
<p class="text-gray-700 mb-4">
Toute utilisation illicite ou nuisible, ou pouvant empêcher le fonctionnement normal du site, est interdite.
</p>
<p class="text-gray-700 mb-4">
La reproduction, la distribution ou la modification totale ou partielle du contenu est interdite sans autorisation expresse du titulaire.
</p>
HTML;

        $securityMeasuresFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Mesures de sécurité</h2>
<p class="text-gray-700 mb-4">
L’utilisateur garantit l’authenticité et la véracité des données communiquées via les formulaires de contact et est responsable de leur mise à jour. Il est responsable de toute information inexacte ou fausse.
</p>
<p class="text-gray-700 mb-4">
Les données personnelles peuvent être stockées dans des bases de données, automatisées ou non, appartenant exclusivement au titulaire du site, qui applique des mesures techniques, organisationnelles et de sécurité. Toutefois, les mesures de sécurité sur Internet ne sont pas totalement fiables et l’absence de logiciels malveillants ne peut être garantie de manière absolue.
</p>
HTML;

        $ipRightsFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Droits de propriété intellectuelle</h2>
<p class="text-gray-700 mb-4">
L’utilisateur s’engage à respecter les droits de propriété intellectuelle du titulaire. L’accès à ce site ne confère aucun droit sur les marques, noms commerciaux ou autres signes distinctifs.
</p>
<p class="text-gray-700 mb-4">
La reproduction, la distribution ou la modification totale ou partielle du contenu est interdite sans autorisation expresse du titulaire.
</p>
<p class="text-gray-700 mb-4">
Les téléchargements à des fins commerciales sont interdits. L’utilisation commerciale du contenu sans autorisation expresse est interdite.
</p>
HTML;

        $warrantyExclusionFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Exclusion de garanties et responsabilité</h2>
<p class="text-gray-700 mb-4">
Le responsable du site n’accorde aucune garantie et ne saurait être tenu responsable des dommages résultant notamment de :
</p>
<ul class="list-disc pl-6 text-gray-700 mb-4 space-y-2">
  <li>L’indisponibilité, le défaut de maintenance ou le mauvais fonctionnement du site, des services ou des contenus.</li>
  <li>La présence de logiciels malveillants dans les contenus.</li>
  <li>Une utilisation illicite, négligente ou frauduleuse du site.</li>
</ul>
HTML;

        $modificationsFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Modifications</h2>
<p class="text-gray-700 mb-4">
Le responsable se réserve le droit de modifier le site sans préavis, y compris en changeant, supprimant ou ajoutant des contenus et services, ainsi que leur présentation.
</p>
HTML;

        $applicableLawFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Loi applicable et juridiction</h2>
<p class="text-gray-700 mb-4">
Les présentes conditions sont soumises à la législation espagnole et aux tribunaux compétents conformément à la loi.
</p>
HTML;

        // Guardado (1 registro global)
        LegalPage::updateOrCreate(
            ['id' => 1],
            [
                'page_title_es' => $pageTitleEs,
                'page_title_en' => $pageTitleEn,
                'page_title_fr' => $pageTitleFr,

                'ident_info_es' => $identInfoEs,
                'ident_info_en' => $identInfoEn,
                'ident_info_fr' => $identInfoFr,

                'ip_rights_es' => $ipRightsEs,
                'ip_rights_en' => $ipRightsEn,
                'ip_rights_fr' => $ipRightsFr,

                'terms_use_es' => $termsUseEs,
                'terms_use_en' => $termsUseEn,
                'terms_use_fr' => $termsUseFr,

                'warranty_exclusion_es' => $warrantyExclusionEs,
                'warranty_exclusion_en' => $warrantyExclusionEn,
                'warranty_exclusion_fr' => $warrantyExclusionFr,

                'security_measures_es' => $securityMeasuresEs,
                'security_measures_en' => $securityMeasuresEn,
                'security_measures_fr' => $securityMeasuresFr,

                'modifications_es' => $modificationsEs,
                'modifications_en' => $modificationsEn,
                'modifications_fr' => $modificationsFr,

                'applicable_law_es' => $applicableLawEs,
                'applicable_law_en' => $applicableLawEn,
                'applicable_law_fr' => $applicableLawFr,

                'last_updated_at' => Carbon::today(),

                'seo_title_es' => 'Aviso legal',
                'seo_title_en' => 'Legal notice',
                'seo_title_fr' => 'Mentions légales',

                'seo_description_es' => 'Información legal, condiciones de uso, propiedad intelectual y responsabilidad del sitio web.',
                'seo_description_en' => 'Legal information, terms of use, intellectual property and liability of the website.',
                'seo_description_fr' => 'Informations légales, conditions d’utilisation, propriété intellectuelle et responsabilité du site.',
            ]
        );
    }
}
