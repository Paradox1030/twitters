<?php

namespace App\Jobs;

use App\Models\Twitters;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class MessageQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $twitters;

    /**
     * Create a new job instance.
     *
     * @param array $twitters
     */
    public function __construct($twitters)
    {
        $this->twitters = $twitters;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::table('twitters')->insert([
            'categoryId' => $this->twitters['categoryId'],
            'userName' => $this->twitters['userName'],
            'content' => $this->twitters['content'],
            'created_at' => Carbon::now()
        ]);
    }
}
