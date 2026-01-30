<?php

namespace Database\Seeders;

use App\Models\CookiesPage;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CookiesPageSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Título principal con el mismo HTML que vienes usando
        $titleEs = <<<'HTML'
<h1 class="text-3xl md:text-4xl font-bold text-center py-10 text-gray-900 mb-20">Política de Cookies</h1>
HTML;

        // ✅ Columna izquierda (3 párrafos como en la captura)
        $introEs = <<<'HTML'
<p class="text-gray-700 mb-4">
El acceso a este Sitio Web puede implicar la utilización de cookies. Las cookies son pequeñas cantidades de información que se almacenan en el navegador utilizado por cada Usuario —en los distintos dispositivos que pueda utilizar para navegar— para que el servidor recuerde cierta información que posteriormente y únicamente el servidor que la implementó leerá. Las cookies facilitan la navegación, la hacen más amigable, y no dañan el dispositivo de navegación.
</p>
HTML;

        $collectedEs = <<<'HTML'
<p class="text-gray-700 mb-4">
Las cookies son procedimientos automáticos de recogida de información relativa a las preferencias determinadas por el Usuario durante su visita al Sitio Web con el fin de reconocerlo como Usuario, y personalizar su experiencia y el uso del Sitio Web, y pueden también, por ejemplo, ayudar a identificar y resolver errores.
</p>

<p class="text-gray-700">
La información recabada a través de las cookies puede incluir la fecha y hora de visitas al Sitio Web, las páginas visionadas, el tiempo que ha estado en el Sitio Web y los sitios visitados justo antes y después del mismo. Sin embargo, ninguna cookie permite que esta misma pueda contactarse con el número de teléfono del Usuario o con cualquier otro medio de contacto personal.
</p>
HTML;

        // ✅ Columna derecha (2 párrafos + heading + párrafo)
        $personalNoteEs = <<<'HTML'
<p class="text-gray-700 mb-4">
Ninguna cookie puede extraer información del disco duro del Usuario o robar información personal. La única manera de que la información privada del Usuario forme parte del archivo Cookie es que el usuario dé personalmente esa información al servidor.
</p>
HTML;

        $consentEs = <<<'HTML'
<p class="text-gray-700 mb-4">
Las cookies que permiten identificar a una persona se consideran datos personales. Por tanto, a las mismas les será de aplicación la Política de Privacidad anteriormente descrita. En este sentido, para la utilización de las mismas será necesario el consentimiento del Usuario. Este consentimiento será comunicado, en base a una elección auténtica, ofrecido mediante una decisión afirmativa y positiva, antes del tratamiento inicial, removible y documentado.
</p>
HTML;

        $disableEs = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Deshabilitar, rechazar y eliminar cookies</h2>

<p class="text-gray-700 mb-4">
El Usuario puede deshabilitar, rechazar y eliminar las cookies —total o parcialmente— instaladas en su dispositivo mediante la configuración de su navegador (entre los que se encuentran, por ejemplo, Chrome, Firefox, Safari, Explorer). En este sentido, los procedimientos para rechazar y eliminar las cookies pueden diferir de un navegador de Internet a otro.
</p>

<p class="text-gray-700">
En consecuencia, el Usuario debe acudir a las instrucciones facilitadas por el propio navegador de Internet que esté utilizando. En el supuesto de que rechace el uso de cookies —total o parcialmente— podrá seguir usando el Sitio Web, si bien podrá tener limitada la utilización de algunas de las prestaciones del mismo.
</p>
HTML;

        // ✅ EN (básico, puedes afinar luego)
        $titleEn = <<<'HTML'
<h1 class="text-3xl md:text-4xl font-bold text-center py-10 text-gray-900 mb-20">Cookies Policy</h1>
HTML;

        $introEn = <<<'HTML'
<p class="text-gray-700 mb-4">
Access to this Website may involve the use of cookies. Cookies are small pieces of information stored in the browser used by each User—on any device used to browse—so the server can remember certain information that only the server that implemented it will later read. Cookies help navigation, make it more user-friendly, and do not damage the device.
</p>
HTML;

        $collectedEn = <<<'HTML'
<p class="text-gray-700 mb-4">
Cookies are automatic procedures for collecting information about a User’s preferences during their visit, in order to recognize them as a User, personalize their experience, and help identify or fix errors.
</p>
<p class="text-gray-700">
Information collected may include visit date/time, pages viewed, time spent, and sites visited before/after. However, no cookie allows contacting the User by phone number or any personal contact method.
</p>
HTML;

        $personalNoteEn = <<<'HTML'
<p class="text-gray-700 mb-4">
No cookie can extract information from the User’s hard drive or steal personal information. The only way for private information to be part of the Cookie file is if the User personally provides that information to the server.
</p>
HTML;

        $consentEn = <<<'HTML'
<p class="text-gray-700 mb-4">
Cookies that can identify a person are considered personal data and therefore are subject to the Privacy Policy. Their use requires the User’s consent, given through a genuine choice and an affirmative, positive decision before initial processing, removable and documented.
</p>
HTML;

        $disableEn = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Disable, reject and delete cookies</h2>
<p class="text-gray-700 mb-4">
Users can disable, reject and delete cookies—totally or partially—through their browser settings (e.g., Chrome, Firefox, Safari, Explorer). The steps may vary by browser.
</p>
<p class="text-gray-700">
If cookies are rejected (totally or partially), the Website may still be used, but some features could be limited.
</p>
HTML;

        // ✅ FR (básico)
        $titleFr = <<<'HTML'
<h1 class="text-3xl md:text-4xl font-bold text-center py-10 text-gray-900 mb-20">Politique de cookies</h1>
HTML;

        $introFr = <<<'HTML'
<p class="text-gray-700 mb-4">
L’accès à ce site peut impliquer l’utilisation de cookies. Les cookies sont de petites quantités d’informations stockées dans le navigateur utilisé par l’Utilisateur afin que le serveur se souvienne de certaines informations. Ils facilitent la navigation et ne nuisent pas à l’appareil.
</p>
HTML;

        $collectedFr = <<<'HTML'
<p class="text-gray-700 mb-4">
Les cookies collectent automatiquement des informations sur les préférences de l’Utilisateur afin de le reconnaître, personnaliser son expérience et aider à identifier/résoudre des erreurs.
</p>
<p class="text-gray-700">
Les informations peuvent inclure date/heure de visite, pages consultées, temps passé, et sites visités avant/après. Aucune cookie ne permet de contacter l’Utilisateur via un numéro de téléphone ou un autre moyen personnel.
</p>
HTML;

        $personalNoteFr = <<<'HTML'
<p class="text-gray-700 mb-4">
Aucun cookie ne peut extraire des informations du disque dur ou voler des informations personnelles. Les informations privées ne font partie du fichier Cookie que si l’Utilisateur les fournit lui-même au serveur.
</p>
HTML;

        $consentFr = <<<'HTML'
<p class="text-gray-700 mb-4">
Les cookies permettant d’identifier une personne sont considérés comme des données personnelles et sont soumis à la Politique de confidentialité. Leur utilisation nécessite le consentement de l’Utilisateur, donné de manière affirmative, révocable et documentée.
</p>
HTML;

        $disableFr = <<<'HTML'
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Désactiver, refuser et supprimer les cookies</h2>
<p class="text-gray-700 mb-4">
L’Utilisateur peut désactiver, refuser et supprimer les cookies (totalement ou partiellement) via les paramètres de son navigateur (Chrome, Firefox, Safari, Explorer, etc.). Les procédures varient selon le navigateur.
</p>
<p class="text-gray-700">
En cas de refus (total ou partiel), le site peut rester accessible mais certaines fonctionnalités peuvent être limitées.
</p>
HTML;

        CookiesPage::updateOrCreate(
            ['id' => 1],
            [
                'page_title_es' => $titleEs,
                'page_title_en' => $titleEn,
                'page_title_fr' => $titleFr,

                'intro_es' => $introEs,
                'intro_en' => $introEn,
                'intro_fr' => $introFr,

                'collected_info_es' => $collectedEs,
                'collected_info_en' => $collectedEn,
                'collected_info_fr' => $collectedFr,

                'personal_data_note_es' => $personalNoteEs,
                'personal_data_note_en' => $personalNoteEn,
                'personal_data_note_fr' => $personalNoteFr,

                'consent_es' => $consentEs,
                'consent_en' => $consentEn,
                'consent_fr' => $consentFr,

                'disable_reject_delete_es' => $disableEs,
                'disable_reject_delete_en' => $disableEn,
                'disable_reject_delete_fr' => $disableFr,

                'last_updated_at' => Carbon::create(2023, 1, 1),

                'seo_title_es' => 'Política de Cookies',
                'seo_title_en' => 'Cookies Policy',
                'seo_title_fr' => 'Politique de cookies',

                'seo_description_es' => 'Información sobre el uso de cookies, consentimiento y cómo deshabilitarlas o eliminarlas.',
                'seo_description_en' => 'Information about cookies usage, consent, and how to disable or delete them.',
                'seo_description_fr' => 'Informations sur l’utilisation des cookies, le consentement et la désactivation/suppression.',
            ]
        );
    }
}
