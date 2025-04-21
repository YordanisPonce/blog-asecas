<?php

namespace App\Models;

use App\Notifications\DynamicNotification;
use App\Services\EventService;
use App\Traits\HasSlug;
use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{

    use HasSlug, Upload;
    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'date',
        'start_time',
        'end_time',
        'location',
        'type',
        'slug',
        'active',
        'photo',
        'meeting_link'
    ];


    protected static array $slugAttributes = ['title'];

    protected function photo(): Attribute
    {

        $isUser = request()->input('is_user');
        return Attribute::make(
            get: fn($item) => $item && $isUser ? $this->generateUrl($item) : $item
        );

    }


    public function setPhotoAttribute($value)
    {
        $source = collect(explode("/", $value));
        if ($source->count() > 2) {
            $fileName = $source->pop();
            $fileFolder = $source->pop();
            $source = "$fileFolder/$fileName";
        } else {
            $source = $value;
        }

        $this->attributes['photo'] = $source;
    }

    public function notify(SubscriptionEmail $recipient)
    {

        $eventService = app()->make(EventService::class);
        $value = $this;
        Carbon::setLocale('es');
        $prettyDate = Carbon::parse(Carbon::parse($value->date)->format("Y-m-d") . ' ' . $value->start_time)->translatedFormat('d \d\e F \d\e Y \a \l\a\s g:i A');
        $address = $value->meeting_link ? $value->meeting_link : $value->location;
        $hour = Carbon::parse($value->start_time)->format('g:i A');
        $description = Str::limit(strip_tags($value->description), 150);
        $eventHtml = [
            "<h1>Hola, $recipient->email</h1>",
            "Te has suscrito al evento <strong>”{$value->title}”</strong>, que se celebrará el próximo $prettyDate, en {$address}.",
            "<h2> Datos del evento:</h2>",
            [
                "📅 Fecha: $prettyDate",
                "🕒 Hora:  $hour",
                "📍 Lugar: $address",
                "📝 Tema: $description",
            ],
            "Te recomendamos llegar con unos minutos de antelación para facilitar la organización.",
            "En caso de no poder asistir, por favor avísanos respondiendo a este correo.",
            "¡Te esperamos!",
        ];

        $buttonUrl = '
            <center>
                <a href="https://derecho-ciudadano.com/eventos" style="background-color:#309CAA;color:#fff;padding:12px 24px;border-radius:6px;text-decoration:none;font-weight:bold;margin:auto">
                    Ver todos los eventos
                </a>
            </center>
        ';

        $message = [
            ...$eventHtml,
            $buttonUrl,

        ];


        $recipient->notify(new DynamicNotification([
            'subject' => "Notificación de asistencia al evento {$value->title}",
            'message' => $message
        ]));


    }
}
