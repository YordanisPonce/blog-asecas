<?php
namespace App\Services;
use App\Models\Event;
use App\Notifications\DynamicNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class EventService extends Service
{
    public function __construct(private readonly SubscriptionEmailService $subscriptionEmailService)
    {
        $this->record = new Event;
    }

    public function notify($options = [])
    {
        $news = $this->record->newQuery()->whereDate('date', '>=', Carbon::now())->where('active', true)->get();
        if ($news->count() >= $options['minNews']) {
            $recipients = $this->subscriptionEmailService->getRecipients([
                'query' => fn($query) => $query->whereHas('events')
            ]);

            foreach ($recipients as $recipient) {
                $token = Str::random(40);
                $recipient->update(['email_verified_token' => $token]);

                $verification_link = route('unverify-email', ['token' => $token]);

                $buttonUrl = '
                    <center>
                        <a href="https://derecho-ciudadano.com/eventos" style="background-color:#309CAA;color:#fff;padding:12px 24px;border-radius:6px;text-decoration:none;font-weight:bold;margin:auto">
                            Ver todos los eventos
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
                        'subject' => "Nuevos eventos para estar al día con tus derechos",
                        'message' => [
                            'Hola',
                            'Ya tienes disponibles los últimos eventos en Derecho Ciudadano. Esta semana te traemos eventos pensados para ayudarte a comprender y ejercer tus derechos de forma sencilla y práctica.',
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
                    <a href="%s" style="
                        background-color: red;
                        color: white;
                        padding: 8px 16px;
                        text-decoration: none;
                        border-radius: 4px;
                        font-size: 14px;
                        display: inline-block;
                        margin-top: 8px;
                    ">Entrar al meet</a>
                </div>',
                $item->photo, // Asegúrate que este campo contenga la URL absoluta de la imagen
                e($item->title),
                e($item->title),
                Str::limit(strip_tags($item->description), 150),
                "https://derecho-ciudadano.com/eventos/{$item->slug}",
                $item->meeting_link

            );
        })->toArray();
    }
}
