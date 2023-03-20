<?php

namespace App\Console\Commands;

use App\Jobs\CreateRecord;
use Illuminate\Console\Command;

class createNTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-n-tasks {n}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create n test tasks';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        for ($i = 1; $i <= $this->argument('n'); $i++) {
            CreateRecord::dispatch();
        }
    }
}
