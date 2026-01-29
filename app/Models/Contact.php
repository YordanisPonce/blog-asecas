<?php

namespace App\Models;

use App\Notifications\DynamicNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class Contact extends Model
{
    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'subject',
        'speciality',
        'message',
        'consent_privacy',
        'consent_commercial',
        'lang',
        'ip',
        'user_agent',
        'cv_path',
        'cv_original_name',
        'cv_mime',
    ];

    protected $casts = [
        'consent_privacy' => 'boolean',
        'consent_commercial' => 'boolean',
    ];

    public function getCvUrlAttribute(): ?string
    {
        if (!$this->cv_path) return null;
        return Storage::disk('public')->url($this->cv_path);
    }

    public function notifyAdmin(): void
    {
        $to = config('mail.contact_to', 'administracion@grupoestucalia.com');
        $safeMsg = nl2br(e((string) $this->message));

        $subject = $this->type === 'work'
            ? 'Nuevo CV – Trabaja con nosotros'
            : ('Nuevo mensaje de contacto: ' . ($this->subject ?: $this->name));

        $file = null;
        if ($this->cv_path) {
            $abs = Storage::disk('public')->path($this->cv_path);
            if (is_file($abs)) {
                $file = [
                    'path' => $abs,
                    'mime' => $this->cv_mime ?: 'application/octet-stream',
                    'name' => $this->cv_original_name ?: basename($abs),
                ];
            }
        }

        Notification::route('mail', $to)->notify(
            new DynamicNotification([
                'subject' => $subject,
                'message' => array_filter([
                    "<p><strong>Tipo:</strong> " . e($this->type) . "</p>",
                    "<p><strong>Nombre:</strong> " . e($this->name) . "</p>",
                    "<p><strong>Email:</strong> " . e($this->email) . "</p>",
                    $this->phone ? "<p><strong>Teléfono:</strong> " . e($this->phone) . "</p>" : null,
                    $this->subject ? "<p><strong>Asunto:</strong> " . e($this->subject) . "</p>" : null,
                    $this->speciality ? "<p><strong>Especialidad:</strong> " . e($this->speciality) . "</p>" : null,
                    "<p><strong>Mensaje:</strong></p>",
                    "<p>{$safeMsg}</p>",
                    "<hr/>",
                    "<p><small><strong>Consentimiento privacidad:</strong> " . ($this->consent_privacy ? 'Sí' : 'No') . "</small></p>",
                    "<p><small><strong>Consentimiento comercial:</strong> " . ($this->consent_commercial ? 'Sí' : 'No') . "</small></p>",
                    $this->ip ? "<p><small><strong>IP:</strong> " . e($this->ip) . "</small></p>" : null,
                ]),
                'file' => $file, // ✅ adjunta CV si existe
            ])
        );
    }
}
