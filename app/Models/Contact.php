<?php

namespace App\Models;

use App\Notifications\DynamicNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'consent_privacy',
        'consent_commercial',
        'lang',
        'ip',
        'user_agent',
    ];

    protected $casts = [
        'consent_privacy' => 'boolean',
        'consent_commercial' => 'boolean',
    ];

    public function notifyAdmin(): void
    {
        $to = config('mail.contact_to', 'administracion@grupoestucalia.com');

        $safeMsg = nl2br(e((string) $this->message));

        Notification::route('mail', $to)->notify(
            new DynamicNotification([
                'subject' => "Nuevo mensaje de contacto: " . ($this->subject ?: $this->name),
                'message' => array_filter([
                    "<p><strong>Nombre:</strong> " . e($this->name) . "</p>",
                    "<p><strong>Email:</strong> " . e($this->email) . "</p>",
                    $this->phone ? "<p><strong>Teléfono:</strong> " . e($this->phone) . "</p>" : null,
                    $this->subject ? "<p><strong>Asunto:</strong> " . e($this->subject) . "</p>" : null,
                    "<p><strong>Mensaje:</strong></p>",
                    "<p>{$safeMsg}</p>",
                    "<hr/>",
                    "<p><small><strong>Consentimiento privacidad:</strong> " . ($this->consent_privacy ? 'Sí' : 'No') . "</small></p>",
                    "<p><small><strong>Consentimiento comercial:</strong> " . ($this->consent_commercial ? 'Sí' : 'No') . "</small></p>",
                    $this->ip ? "<p><small><strong>IP:</strong> " . e($this->ip) . "</small></p>" : null,
                ]),
                'file' => null, // tu formulario actual NO usa cv
            ])
        );
    }
}
