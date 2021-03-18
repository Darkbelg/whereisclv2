<?php

namespace App\Console\Commands;

use App\Refresh;
use Illuminate\Console\Command;

class RefreshVideos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh all youtube videos data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Refresh::all(app(\App\Service\YoutubeApi::class));

        return 0;
    }
}
