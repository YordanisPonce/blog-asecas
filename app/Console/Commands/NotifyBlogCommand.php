<?php

namespace App\Console\Commands;

use App\Services\BlogService;
use Illuminate\Console\Command;

class NotifyBlogCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(BlogService $blogService)
    {

        $blogService->notify([
            'minNews' => 3
        ]);
    }
}
