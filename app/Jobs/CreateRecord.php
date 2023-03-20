<?php

namespace App\Jobs;

use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateRecord implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $env = config('app.env');
        $jobId = $this->job->getJobId();
        $startedAt = Carbon::now()->toString();

        $a = 0;
        for($i = 0; $i < 2000000000; $i++) {
            $a += $i;
        }

        $rec = Record::create([
            'data' => json_encode([
                'env' => $env,
                'job_id' => $jobId,
                'started_at' => $startedAt,
            ]),
        ]);

        return $rec;
    }
}
