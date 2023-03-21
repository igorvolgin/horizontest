<?php

namespace App\Console\Commands;

use App\Jobs\CreateRecord;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class createBatchOfNTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-n-tasks-batch {n}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create n test tasks in a batch';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $jobs = [];
        for ($i = 1; $i <= $this->argument('n'); $i++) {
            $jobs[] = new CreateRecord($i);
        }

        $batch = Bus::batch($jobs)->dispatch();
    }
}
