<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;

class GetEventsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all events and their photo attributes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::all();
        
        if ($events->isEmpty()) {
            $this->info('No events found in the database.');
            return;
        }
        
        $this->info('Found ' . $events->count() . ' events:');
        $this->newLine();
        
        foreach ($events as $index => $event) {
            $this->info('Event #' . ($index + 1) . ':');
            $this->line('Title: ' . ($event->title ?? 'N/A'));
            $this->line('Photo: ' . ($event->photo ?? 'N/A'));
            $this->line('Photo URL: ' . ($event->photo ? $event->generateUrl($event->photo) : 'N/A'));
            $this->line('-------------------');
        }
    }
} 