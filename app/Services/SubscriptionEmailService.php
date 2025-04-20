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
        if (!$model || $model->hasVerifiedEmail()) {
            return false;
        }
        $model->markEmailAsVerified();
        return true;
    }
    public function unVerify($token)
    {
        $model = $this->record->newQuery()->where('email_verified_token', $token)->first();
        if (!$model) {
            return false;
        }
        return $model->markEmailAsUnVerified();
    }

    public function getRecipients(array $options = [])
    {
        $query = $this->record->newQuery()->whereNotNull('email_verified_at');
        if (isset($options['query'])) {
            $query->where($options['query']);
        }
        return $query->get();
    }


    public function save(array $attributes)
    {
        $model = parent::save($attributes);
        $model->sendEmailVerificationNotification();
        return $model;
    }


}