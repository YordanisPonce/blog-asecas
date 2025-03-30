<?php
namespace App\Services;
use App\Models\Event;

class EventService extends Service
{
    public function __construct()
    {
        $this->record = new Event;
    }

}
