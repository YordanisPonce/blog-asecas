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
                        'subject' => "Nuevas notificaciones: {$news->count()} actualizaciones importantes",
                        'message' => $message
                    ]));
            }
        }

    }


    private function generateNewsHtml($news): array
    {
        return $news->map(function ($item) {
            return sprintf('
                <div style="margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid #eee;">
                    <img src="%s" alt="%s" style="width:100%%;max-width:600px;margin-bottom:12px;border-radius:8px;">
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
