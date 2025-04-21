<?php

namespace App\Console\Commands;

use App\Services\EventService;
use Illuminate\Console\Command;

class NotifyEventCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify-event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(
        EventService $eventService
    ) {
        $eventService->notify();
    }
}
