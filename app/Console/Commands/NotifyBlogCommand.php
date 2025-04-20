<?php

namespace App\Console\Commands;

use App\Services\BlogService;
use App\Services\EventService;
use Illuminate\Console\Command;

class NotifyBlogCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify {--notify-limit=} {--update=1}';

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
        BlogService $blogService,
        EventService $eventService
    ) {
        request()->merge(['is_user' => true]);
        $blogService->notify([
            'minNews' => $this->option('notify-limit') ?? 3,
            'update' => $this->option('update')
        ]);

        $eventService->notify([
            'minNews' => $this->option('notify-limit') ?? 3,
            'update' => $this->option('update')
        ]);
    }
}
