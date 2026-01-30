<?php

namespace Database\Seeders;

use App\Models\PrivacyPage;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PrivacyPageSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Título (misma estructura HTML que tu aviso legal)
        $pageTitleEs = <<<'HTML'
<h1 class="text-3xl md:text-4xl font-bold text-center py-10 text-gray-900 mb-20">Política de privacidad</h1>
HTML;

        // ✅ IZQUIERDA (según tu maqueta)
        $introEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Introducción</h2>

<p class="text-gray-700 mb-4">
En Grupo Estucalia nos preocupamos por la seguridad y protección de la información personal aportada por nuestros clientes y demás personas. Por ello, hemos actualizado y adaptado nuestra política de protección de datos con motivo de la entrada en vigor de la nueva legislación europea y española: el Reglamento General de Protección de Datos (RGPD), aplicable a partir del 25 de mayo de 2018, y la Ley Orgánica 3/2018, de 5 de diciembre, que adapta el ordenamiento jurídico español a dicho Reglamento.
</p>

<p class="text-gray-700 mb-4">
A continuación le explicamos quién es el responsable del tratamiento de sus datos personales, con qué finalidad recabamos su información personal, cuál es la base jurídica para poder tratar sus datos, a quién podemos comunicar sus datos personales, si efectuamos o no transferencias internacionales de datos, durante cuánto tiempo conservaremos su información personal y cómo puede ejercer sus derechos.
</p>
HTML;

        $controllerInfoEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">¿Quién es el responsable del tratamiento de sus datos personales?</h2>

<p class="text-gray-700 mb-4">
El Reglamento General de Protección de Datos (RGPD) describe al Responsable del tratamiento como la persona física o jurídica, autoridad pública, servicio u otro organismo que, solo o junto con otros, determine los fines y los medios del tratamiento.
</p>

<p class="text-gray-700 mb-4">
<strong>Grupo Estucalia, Dpto. de Calidad</strong>, es responsable del tratamiento de los datos personales que reciba de sus clientes.
</p>

<p class="text-gray-700 mb-4">
Si tiene cualquier tipo de consulta o quiere comunicarse con nosotros, puede enviar un correo electrónico a <strong>grupoestucalia@grupoestucalia.com</strong>, o bien dirigirnos un escrito a: <strong>Camino Viejo de Fortuna, 40 – Matanzas, 30148 – Santomera (Murcia)</strong>.
</p>
HTML;

        $purposeEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">¿Con qué finalidad recabamos su información personal?</h2>

<p class="text-gray-700 mb-4">
En GRUPO ESTUCALIA estamos concienciados sobre la protección de los datos personales y la privacidad. La finalidad del Grupo Estucalia – Dpto. de Calidad es la de prestar con la máxima calidad nuestros servicios.
</p>
HTML;

        $legalBasisEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">¿Cuál es la base jurídica para que podamos tratar sus datos?</h2>

<p class="text-gray-700 mb-4">
Al ser la finalidad del Grupo Estucalia la de prestar con la máxima calidad nuestros servicios, la base jurídica no es otra que la de dar cumplimiento a la ejecución del contrato de prestación de servicios que nos une con cada cliente.
</p>
HTML;

        $securityMeasuresEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Medidas para proteger su información personal</h2>

<p class="text-gray-700 mb-4">
En Grupo Estucalia nos comprometemos a proteger su información personal. Utilizamos las medidas técnicas y organizativas adecuadas con la finalidad de proteger su información personal y su privacidad, y revisamos dichas medidas periódicamente.
</p>

<p class="text-gray-700 mb-4">
En particular, establecemos medidas encaminadas a garantizar la confidencialidad, integridad, disponibilidad y resiliencia permanentes de los sistemas y servicios de tratamiento, a restaurar la disponibilidad y el acceso a los datos personales de forma rápida en caso de incidente físico o técnico y a asegurar la seguridad en el tratamiento de sus datos personales.
</p>

<p class="text-gray-700 mb-4">
También nuestros empleados se encuentran debidamente formados y capacitados, y se comprometen a guardar la máxima reserva y secreto sobre cualquier dato de carácter personal al que puedan tener acceso como consecuencia de su trabajo, así como a cumplir las medidas de seguridad correspondientes de las que han sido informados convenientemente.
</p>
HTML;

        $modificationsEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Modificaciones a la presente información de protección de datos</h2>

<p class="text-gray-700 mb-4">
En Grupo Estucalia revisamos y actualizamos la información de protección de datos al menos una vez al año, o cuando se produzcan modificaciones en la legislación o en alguna de las operaciones y procedimientos de tratamiento de su información personal. En estos casos indicamos el contenido y/o la fecha de la última actualización.
</p>

<p class="text-gray-700 mb-4">
Esta información de protección de datos fue revisada y actualizada por última vez en <strong>enero de 2023</strong>.
</p>
HTML;

        // ✅ DERECHA (según tu maqueta)
        $dataSharingEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">¿A quién podemos comunicar su información personal?</h2>

<p class="text-gray-700 mb-4">
En algunos casos, es necesario que comuniquemos la información que el cliente nos ha proporcionado a terceras partes. Es el caso de las asesorías para cumplir con nuestras obligaciones fiscales, contables o laborales.
</p>

<p class="text-gray-700 mb-4">
Las asesorías solo tienen acceso a la información personal estrictamente necesaria para llevar a cabo sus servicios. Se les exige que mantengan confidencialidad sobre la información personal que se les facilita para poder cumplir con sus servicios y no pueden utilizar la información de ningún modo diferente a aquel que hemos solicitado.
</p>

<p class="text-gray-700 mb-4">
Igualmente, su información personal estará a disposición de las Administraciones públicas, jueces y tribunales, para la atención de las posibles responsabilidades nacidas del tratamiento.
</p>
HTML;

        $intlTransfersEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Transferencias internacionales de datos</h2>

<p class="text-gray-700 mb-4">
La información que recabamos reside en España. Grupo Estucalia no realiza el tratamiento de sus datos fuera de la Unión Europea.
</p>
HTML;

        $retentionEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">¿Durante cuánto tiempo conservaremos su información personal?</h2>

<p class="text-gray-700 mb-4">
En Grupo Estucalia mantendremos sus datos personales mientras dure la relación comercial y de prestación de servicios que mantenemos con usted y, en todo caso, durante el plazo de tiempo que legalmente nos venga impuesto.
</p>

<p class="text-gray-700 mb-4">
No obstante, puede usted ejercer su derecho de supresión, oposición y/o limitación del tratamiento de sus datos. En estos casos, mantendremos la información debidamente bloqueada mientras pueda resultar necesaria para el ejercicio o defensa de reclamaciones o pudiera derivarse algún tipo de responsabilidad judicial, legal o contractual de su tratamiento, que deba ser atendida y para lo cual sea necesaria su recuperación.
</p>
HTML;

        $rightsHowtoEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">¿Cómo puede ejercer sus derechos?</h2>

<p class="text-gray-700 mb-4">
Sus derechos están regulados en el Capítulo III (Derechos del interesado) del Reglamento General de Protección de Datos (RGPD).
</p>

<p class="text-gray-700 mb-4">
De acuerdo con lo establecido en el citado Reglamento usted tiene derecho a obtener de Grupo Estucalia confirmación de si estamos o no tratando sus datos y, en tal caso, derecho a obtener el acceso a su información personal, así como a solicitar la rectificación de los datos inexactos o, en su caso, solicitar su supresión cuando, entre otros motivos, los datos ya no sean necesarios para los fines para los que fueron recogidos.
</p>

<p class="text-gray-700 mb-4">
Tendrá derecho a obtener de Grupo Estucalia la limitación del tratamiento de sus datos en los siguientes casos:
</p>

<ul class="list-disc pl-6 text-gray-700 mb-4 space-y-2">
  <li>Cuando usted impugne la exactitud de los datos personales, durante un plazo que permita al responsable verificar la exactitud de los mismos.</li>
  <li>Cuando el tratamiento sea ilícito y usted se oponga a la supresión de los datos personales y solicite en su lugar la limitación de su uso.</li>
  <li>Cuando Grupo Estucalia ya no necesite los datos personales para los fines del tratamiento, pero usted los necesite para la formulación, el ejercicio o la defensa de reclamaciones.</li>
  <li>Cuando usted se haya opuesto al tratamiento, mientras se verifica si los motivos legítimos de Grupo Estucalia prevalecen sobre los suyos propios.</li>
</ul>

<p class="text-gray-700 mb-4">
Para ejercer sus derechos, puede escribirnos a <strong>grupoestucalia@grupoestucalia.com</strong> indicando el derecho que desea ejercer y aportando información que permita su identificación.
</p>
HTML;

        // ✅ EN (puedes ajustar legalmente el wording si quieres)
        $pageTitleEn = <<<'HTML'
<h1 class="text-3xl md:text-4xl font-bold text-center py-10 text-gray-900 mb-20">Privacy Policy</h1>
HTML;

        $introEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Introduction</h2>
<p class="text-gray-700 mb-4">
At Grupo Estucalia we care about the security and protection of personal information provided by our clients and other individuals. Therefore, we have updated this policy in line with Regulation (EU) 2016/679 (GDPR) and Spanish Organic Law 3/2018.
</p>
<p class="text-gray-700 mb-4">
Below we explain who is responsible for data processing, the purposes and legal basis, possible recipients, whether international transfers exist, retention periods, and how to exercise your rights.
</p>
HTML;

        $controllerInfoEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Who is responsible for processing your personal data?</h2>
<p class="text-gray-700 mb-4">
Under the GDPR, the controller is the entity that determines the purposes and means of processing.
</p>
<p class="text-gray-700 mb-4">
<strong>Grupo Estucalia, Quality Department</strong>, is responsible for processing personal data received from clients.
</p>
<p class="text-gray-700 mb-4">
You may contact us at <strong>grupoestucalia@grupoestucalia.com</strong> or by mail at <strong>Camino Viejo de Fortuna, 40 – Matanzas, 30148 – Santomera (Murcia)</strong>.
</p>
HTML;

        $purposeEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">What is the purpose of processing?</h2>
<p class="text-gray-700 mb-4">
The purpose is to provide our services with the highest quality while ensuring the protection of personal data and privacy.
</p>
HTML;

        $legalBasisEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Legal basis</h2>
<p class="text-gray-700 mb-4">
Processing is based on the performance of the service contract with each client and compliance with applicable legal obligations.
</p>
HTML;

        $securityMeasuresEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Security measures</h2>
<p class="text-gray-700 mb-4">
We apply appropriate technical and organizational measures to protect your personal information and review them periodically.
</p>
<p class="text-gray-700 mb-4">
Staff are trained and bound by confidentiality obligations regarding any personal data they may access.
</p>
HTML;

        $modificationsEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Updates to this information</h2>
<p class="text-gray-700 mb-4">
We review and update this information at least annually or when legal/operational changes occur. Last update: <strong>January 2023</strong>.
</p>
HTML;

        $dataSharingEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Who may we share your personal data with?</h2>
<p class="text-gray-700 mb-4">
In some cases we must share information with third parties (e.g., advisors) to comply with tax, accounting, or labor obligations.
</p>
<p class="text-gray-700 mb-4">
Such parties may only access strictly necessary information and must keep it confidential.
</p>
<p class="text-gray-700 mb-4">
Data may also be available to public administrations, courts, and tribunals when required by law.
</p>
HTML;

        $intlTransfersEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">International transfers</h2>
<p class="text-gray-700 mb-4">
The information we collect resides in Spain and is not processed outside the European Union.
</p>
HTML;

        $retentionEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">How long do we keep your data?</h2>
<p class="text-gray-700 mb-4">
We keep personal data for the duration of the commercial/service relationship and for any legally required period.
</p>
<p class="text-gray-700 mb-4">
If you request deletion/objection/limitation, data may be blocked when necessary for legal claims or liabilities.
</p>
HTML;

        $rightsHowtoEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">How can you exercise your rights?</h2>
<p class="text-gray-700 mb-4">
You can exercise GDPR rights (access, rectification, erasure, objection, limitation, etc.) by contacting <strong>grupoestucalia@grupoestucalia.com</strong>.
</p>
<ul class="list-disc pl-6 text-gray-700 mb-4 space-y-2">
  <li>When you contest the accuracy of data (while verification occurs).</li>
  <li>When processing is unlawful and you request restriction instead of erasure.</li>
  <li>When we no longer need the data but you need it for legal claims.</li>
  <li>When you object and we must verify overriding legitimate grounds.</li>
</ul>
HTML;

        // ✅ FR
        $pageTitleFr = <<<'HTML'
<h1 class="text-3xl md:text-4xl font-bold text-center py-10 text-gray-900 mb-20">Politique de confidentialité</h1>
HTML;

        $introFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Introduction</h2>
<p class="text-gray-700 mb-4">
Chez Grupo Estucalia, nous veillons à la sécurité et à la protection des informations personnelles. Cette politique est mise à jour conformément au RGPD (UE 2016/679) et à la Loi organique espagnole 3/2018.
</p>
<p class="text-gray-700 mb-4">
Nous expliquons ci-dessous le responsable du traitement, les finalités, la base juridique, les destinataires, les transferts internationaux, la durée de conservation et l’exercice de vos droits.
</p>
HTML;

        $controllerInfoFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Qui est responsable du traitement de vos données ?</h2>
<p class="text-gray-700 mb-4">
Selon le RGPD, le responsable détermine les finalités et les moyens du traitement.
</p>
<p class="text-gray-700 mb-4">
<strong>Grupo Estucalia, Département Qualité</strong>, est responsable du traitement des données personnelles reçues des clients.
</p>
<p class="text-gray-700 mb-4">
Contact : <strong>grupoestucalia@grupoestucalia.com</strong> — <strong>Camino Viejo de Fortuna, 40 – Matanzas, 30148 – Santomera (Murcia)</strong>.
</p>
HTML;

        $purposeFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Finalité du traitement</h2>
<p class="text-gray-700 mb-4">
La finalité est de fournir nos services avec la plus haute qualité tout en protégeant les données personnelles et la vie privée.
</p>
HTML;

        $legalBasisFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Base juridique</h2>
<p class="text-gray-700 mb-4">
Le traitement repose sur l’exécution du contrat de prestation de services et le respect des obligations légales applicables.
</p>
HTML;

        $securityMeasuresFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Mesures de sécurité</h2>
<p class="text-gray-700 mb-4">
Nous appliquons des mesures techniques et organisationnelles appropriées et les révisons régulièrement. Le personnel est formé et soumis à une obligation de confidentialité.
</p>
HTML;

        $modificationsFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Mises à jour</h2>
<p class="text-gray-700 mb-4">
Nous révisons ces informations au moins une fois par an ou en cas de changements légaux/opérationnels. Dernière mise à jour : <strong>janvier 2023</strong>.
</p>
HTML;

        $dataSharingFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">À qui pouvons-nous communiquer vos données ?</h2>
<p class="text-gray-700 mb-4">
Dans certains cas, nous devons communiquer des informations à des tiers (ex. conseils) pour respecter des obligations fiscales, comptables ou sociales.
</p>
<p class="text-gray-700 mb-4">
Ces tiers n’accèdent qu’aux informations strictement nécessaires et doivent en assurer la confidentialité.
</p>
<p class="text-gray-700 mb-4">
Les données peuvent également être communiquées aux administrations publiques, juges et tribunaux lorsque la loi l’exige.
</p>
HTML;

        $intlTransfersFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Transferts internationaux</h2>
<p class="text-gray-700 mb-4">
Les informations collectées résident en Espagne et ne sont pas traitées en dehors de l’Union européenne.
</p>
HTML;

        $retentionFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Durée de conservation</h2>
<p class="text-gray-700 mb-4">
Nous conservons les données pendant la relation commerciale/de service et pendant la durée légalement requise. En cas de demande de suppression/opposition/limitation, les données peuvent être bloquées si nécessaire pour des réclamations ou responsabilités légales.
</p>
HTML;

        $rightsHowtoFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Comment exercer vos droits ?</h2>
<p class="text-gray-700 mb-4">
Vous pouvez exercer vos droits RGPD (accès, rectification, effacement, opposition, limitation, etc.) en nous contactant à <strong>grupoestucalia@grupoestucalia.com</strong>.
</p>
<ul class="list-disc pl-6 text-gray-700 mb-4 space-y-2">
  <li>Lorsque vous contestez l’exactitude des données (pendant la vérification).</li>
  <li>Lorsque le traitement est illicite et vous demandez la limitation au lieu de l’effacement.</li>
  <li>Lorsque nous n’en avons plus besoin mais vous en avez besoin pour des réclamations.</li>
  <li>Lorsque vous vous opposez et que nous devons vérifier nos motifs légitimes.</li>
</ul>
HTML;

        // ✅ Guardado (1 registro global)
        PrivacyPage::updateOrCreate(
            ['id' => 1],
            [
                'page_title_es' => $pageTitleEs,
                'page_title_en' => $pageTitleEn,
                'page_title_fr' => $pageTitleFr,

                'intro_es' => $introEs,
                'intro_en' => $introEn,
                'intro_fr' => $introFr,

                'controller_info_es' => $controllerInfoEs,
                'controller_info_en' => $controllerInfoEn,
                'controller_info_fr' => $controllerInfoFr,

                'purpose_es' => $purposeEs,
                'purpose_en' => $purposeEn,
                'purpose_fr' => $purposeFr,

                'legal_basis_es' => $legalBasisEs,
                'legal_basis_en' => $legalBasisEn,
                'legal_basis_fr' => $legalBasisFr,

                'security_measures_es' => $securityMeasuresEs,
                'security_measures_en' => $securityMeasuresEn,
                'security_measures_fr' => $securityMeasuresFr,

                'data_sharing_es' => $dataSharingEs,
                'data_sharing_en' => $dataSharingEn,
                'data_sharing_fr' => $dataSharingFr,

                'intl_transfers_es' => $intlTransfersEs,
                'intl_transfers_en' => $intlTransfersEn,
                'intl_transfers_fr' => $intlTransfersFr,

                'retention_es' => $retentionEs,
                'retention_en' => $retentionEn,
                'retention_fr' => $retentionFr,

                'rights_howto_es' => $rightsHowtoEs,
                'rights_howto_en' => $rightsHowtoEn,
                'rights_howto_fr' => $rightsHowtoFr,

                'modifications_es' => $modificationsEs,
                'modifications_en' => $modificationsEn,
                'modifications_fr' => $modificationsFr,

                // En la imagen dice "enero de 2023"
                'last_updated_at' => Carbon::create(2023, 1, 1),

                'seo_title_es' => 'Política de privacidad',
                'seo_title_en' => 'Privacy policy',
                'seo_title_fr' => 'Politique de confidentialité',

                'seo_description_es' => 'Información sobre tratamiento de datos personales, base legal, conservación, destinatarios y ejercicio de derechos.',
                'seo_description_en' => 'Information about personal data processing, legal basis, retention, recipients and rights.',
                'seo_description_fr' => 'Informations sur le traitement des données personnelles, base juridique, conservation, destinataires et droits.',
            ]
        );
    }
}
