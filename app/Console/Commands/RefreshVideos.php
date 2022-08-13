<?php

namespace App\Console\Commands;

use App\Refresh;
use App\Service\YoutubeApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\OutputInterface;

class RefreshVideos extends Command
{
    private $youtubeApi;
    protected $output;

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
     * @param YoutubeApi $youtubeApi
     */
    public function __construct(YoutubeApi $youtubeApi, OutputInterface $output)
    {
        $this->youtubeApi = $youtubeApi;
        $this->output = $output;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            Refresh::all($this->youtubeApi);
        } catch (\Exception $e) {
            $this->output->writeln(
                $e->getMessage(),
                OutputInterface::VERBOSITY_DEBUG
            );
            Log::error($e);
            $this->error('Something went wrong!');
            return 1;
        }
        $this->info('Youtube refresh has been executed.');
        return 0;
    }
}
