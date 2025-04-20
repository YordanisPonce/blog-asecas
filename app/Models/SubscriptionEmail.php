<?php

namespace App\Models;

use App\Notifications\DynamicNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class SubscriptionEmail extends Model implements MustVerifyEmail
{

    use Notifiable;
    protected $fillable = ['email', 'email_verified_token'];

    /**
     * Determine if the user has verified their email address.
     *
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        return !is_null($this->attributes['email_verified_at']);
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => now(),
            'email_verified_token' => null
        ])->save();
    }
    public function markEmailAsUnVerified()
    {
        return $this->forceFill([
            'email_verified_at' => null,
            'email_verified_token' => null
        ])->save();
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        if (!$this->hasVerifiedEmail()) {
            $token = Str::random(40);
            $this->forceFill([
                'email_verified_token' => $token
            ])->save();
            $verification_link = route('verify-email', ['token' => $token]);
            $this->notify(new DynamicNotification([
                'subject' => 'Email de verificación de correo para suscripción',
                'message' => "
                <p>Gracias por suscribirte. Para comenzar a recibir nuestras novedades, por favor verifica tu correo electrónico haciendo clic en el siguiente botón:</p>
                <p style=\"text-align:center;\">
                    <a href=\"{$verification_link}\" style=\"background-color:#309CAA;color:#fff;padding:12px 24px;border-radius:6px;text-decoration:none;font-weight:bold;\">
                        Verificar mi correo
                    </a>
                </p>
                <p>O, si prefieres, copia y pega este enlace en tu navegador:</p>
                <p><a href=\"$verification_link\">{$verification_link}</a></p>
                <p>Si tú no solicitaste esta suscripción, puedes ignorar este correo.</p>
                "
            ]));
        }

    }

    /**
     * Get the email address that should be used for verification.
     *
     * @return string
     */
    public function getEmailForVerification()
    {
        return $this->attributes['email'];
    }

    public function events()
    {

        return $this->belongsToMany(Event::class, 'event_s_emails', 'email_id', 'event_id');
    }
}