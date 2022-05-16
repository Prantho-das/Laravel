<?php

namespace App\Listeners;

use App\Models\Loginfo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogInfoChange
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Loginfo::create([
            'user_id'=>$event->user->id,
            'created_at'=>now()
        ]);
    }
}
