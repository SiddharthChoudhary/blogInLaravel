<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Redis;

class Sendemail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
         $users = Redis::get('name');

        $variable = \GuzzleHttp\json_decode($users) ;
        $data = "hello all";
        foreach ($variable as $task){
            \Mail::raw($data, function ($message)use($task) {
                $message->to($task->email,'frommyside' )
                    ->subject('Someone has also commented on the same blog as you');
            });
        }
    }
}
