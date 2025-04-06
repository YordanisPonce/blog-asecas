<?php

namespace App\Services;

use App\Models\SubscriptionEmail;

class SubscriptionEmailService extends Service
{
    public function __construct()
    {
        $this->record = new SubscriptionEmail;
    }


}