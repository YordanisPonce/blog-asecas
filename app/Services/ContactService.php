<?php
namespace App\Services;
use App\Models\Contact;
use App\Models\Event;

class ContactService extends Service
{
    public function __construct()
    {
        $this->record = new Contact;
    }

}
