<?php

namespace App\Models;

use App\Notifications\DynamicNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'message'];

    public function sendEmail()
    {

        $speciality = request()->input('speciality');
        $phone = request()->input('phone');
        $file = request()->file('cv');
        Notification::route('mail', $this->email)
            ->notify(new DynamicNotification([
                'subject' => "Nuevo mensaje de contacto de {$this->name}",
                'message' => [
                    "<p><strong>Nombre:</strong> {$this->name}</p>",
                    "<p><strong>Email:</strong> {$this->attribyute}</p>",
                    $phone ? "<p><strong>Teléfono:</strong> {$phone}</p>" : "",
                    $speciality ? "<p><strong>Especialidad:</strong> {$speciality}</p>" : "",
                    "<p><strong>Mensaje:</strong></p>",
                    "<p>{$this->message}</p>",
                ],
                'file' => request()->hasFile('cv') ? [
                    'path' => $file->getRealPath(),
                    'mime' => $file->getMimeType(),
                    'name' => $file->getClientOriginalName()
                ] : null
            ]));
    }
}
