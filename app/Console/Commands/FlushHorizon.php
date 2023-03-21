<?php

namespace App\Console\Commands;

use App\Jobs\CreateRecord;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class FlushHorizon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'horizon:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush failed jobs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('queue:flush');
        Redis::connection()
            ->del([config('horizon.prefix').'failed:*']);
        $this->info('each individual failed job flushed');
        Redis::connection()
            ->del([config('horizon.prefix').'failed_jobs']);
        $this->info('failed_jobs flushed');
    }
}
