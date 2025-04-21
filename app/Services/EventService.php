<?php
namespace App\Services;
use App\Models\Event;
use App\Notifications\DynamicNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
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
        $startDate = Carbon::now()->addDay()->toDateString();        // Mañana
        $endDate = Carbon::now()->addDays(2)->toDateString();        // Pasado mañana
        $news = $this->record->newQuery()
            ->whereDate('date', '>=', $startDate)
            ->whereDate('date', '<=', $endDate)
            ->where('active', true)
            ->get();

        Log::debug($news);
        $recipients = $this->subscriptionEmailService->query()->whereHas('events')->get();

        foreach ($recipients as $recipient) {
            $buttonUrl = '
                    <center>
                        <a href="https://derecho-ciudadano.com/eventos" style="background-color:#309CAA;color:#fff;padding:12px 24px;border-radius:6px;text-decoration:none;font-weight:bold;margin:auto">
                            Ver todos los eventos
                        </a>
                    </center>
                ';


            $message = [
                $buttonUrl
            ];
            foreach ($news as $key => $value) {

                Carbon::setLocale('es');
                $prettyDate = Carbon::parse(Carbon::parse($value->date)->format("Y-m-d") . ' ' . $value->start_time)->translatedFormat('d \d\e F \d\e Y \a \l\a\s g:i A');
                $address = $value->meeting_link ? $value->meeting_link : $value->location;
                $hour = Carbon::parse($value->start_time)->format('g:i A');
                $description = Str::limit(strip_tags($value->description), 150);
                Notification::route('mail', $recipient->email)
                    ->notify(new DynamicNotification([
                        'subject' => "Recordatorio de asistencia al evento {$value->title}",
                        'message' => [
                            "<h1> Hola $recipient->email,</h1>",
                            "Queremos recordarte que estás inscrito/a en el evento <strong>”{$value->title}”</strong>, que se celebrará el próximo $prettyDate, en {$address}.",
                            "<h2> Detalles del evento:</h2>",
                            [
                                "📅 Fecha: $prettyDate",
                                "🕒 Hora:  $hour",
                                "📍 Lugar: $address",
                                "📝 Tema: $description",
                            ],
                            "Te recomendamos llegar con unos minutos de antelación para facilitar la organización.",
                            "En caso de no poder asistir, por favor avísanos respondiendo a este correo.",
                            "¡Te esperamos!",
                            ...$message
                        ]
                    ]));
            }

        }

    }


    public function generateNewsHtml($news, $options = []): array
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
