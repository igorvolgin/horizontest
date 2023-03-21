<?php

namespace App\Console\Commands;

use App\Jobs\CreateRecord;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
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
        $batch = Bus::batch($jobs);

        $batch->add(Collection::times($this->argument('n'), function ($i) {
            return new CreateRecord($i);
        }));

        $batch->dispatch();
    }
}
