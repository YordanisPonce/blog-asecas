<?php
namespace App\Services;
use App\Models\Blog;
use App\Notifications\DynamicNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
class BlogService extends Service
{
    public function __construct(private readonly SubscriptionEmailService $subscriptionEmailService)
    {
        $this->record = new Blog;
        $this->with = ['writer'];
    }

    public function notify($options = [])
    {
        $news = $this->record->newQuery()->where('notified', false)->get();
        if ($news->count() >= $options['minNews']) {

            $recipients = $this->subscriptionEmailService->getRecipients();

            foreach ($recipients as $recipient) {
                $token = Str::random(40);
                $recipient->update(['email_verified_token' => $token]);

                $verification_link = route('unverify-email', ['token' => $token]);

                $buttonUrl = '
                    <center>
                        <a href="https://derecho-ciudadano.com/noticias" style="background-color:#309CAA;color:#fff;padding:12px 24px;border-radius:6px;text-decoration:none;font-weight:bold;margin:auto">
                            Ver todas las noticias
                        </a>
                    </center>
                ';

                $message = [
                    ...$this->generateNewsHtml($news),
                    $buttonUrl,
                    "
                    <center>
                        <br>
                        <p style=\"margin-bottom:2px\">Pulsa el enlace de abajo para dejar de recibir noticias</p>
                        <p><a href=\"$verification_link\">$verification_link</a></p>
                    </center>"
                ];

                Notification::route('mail', $recipient->email)
                    ->notify(new DynamicNotification([
                        'subject' => "Nuevos artículos legales para estar al día con tus derechos",
                        'message' => [
                            'Hola',
                            'Ya tienes disponibles los últimos contenidos en Derecho Ciudadano. Esta semana te traemos artículos pensados para ayudarte a comprender y ejercer tus derechos de forma sencilla y práctica.',
                            '<h1>Lo más reciente:</h1>',
                            ...$message,
                            '<small><strong>Recuerda: al estar suscrito, también puedes acceder a nuestros modelos de reclamación y formularios gratuitos, además de recibir orientación legal básica.</strong></small>'
                        ]
                    ]));
            }
        }

    }


    private function generateNewsHtml($news, $options = []): array
    {
        return $news->map(function ($item) use ($options) {

            $item->update(['notified' => true]);

            return sprintf('
                <div style="margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid #eee;">
                    <img src="%s" alt="%s" style="width:100%%;max-width:600px;margin-bottom:12px;border-radius:8px;object-fit:cover" height="180">
                    <h3 style="color: #1a1a1a;">%s</h3>
                    <p style="color: #555;">%s</p>
                    <a href="%s" style="
                        background-color: #4CAF50;
                        color: white;
                        padding: 8px 16px;
                        text-decoration: none;
                        border-radius: 4px;
                        font-size: 14px;
                        display: inline-block;
                        margin-top: 8px;
                    ">Ver detalles</a>
                </div>',
                $item->photo, // Asegúrate que este campo contenga la URL absoluta de la imagen
                e($item->title),
                e($item->title),
                Str::limit(strip_tags($item->description), 150),
                "https://derecho-ciudadano.com/noticias/{$item->slug}"
            );
        })->toArray();
    }
}
