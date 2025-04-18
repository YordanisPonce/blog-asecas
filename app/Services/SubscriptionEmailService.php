<?php

namespace App\Services;

use App\Models\SubscriptionEmail;

class SubscriptionEmailService extends Service
{
    public function __construct()
    {
        $this->record = new SubscriptionEmail;
    }

    public function verify($token)
    {
        $model = $this->record->newQuery()->where('email_verified_token', $token)->first();
        if (!$model) {
            return false;
        }
        return $model->markEmailAsVerified();
    }
    public function unVerify($token)
    {
        $model = $this->record->newQuery()->where('email_verified_token', $token)->first();
        if (!$model) {
            return false;
        }
        return $model->markEmailAsUnVerified();
    }

    public function getRecipients()
    {
        return $this->record->newQuery()->whereNotNull('email_verified_at')->get();
    }


}