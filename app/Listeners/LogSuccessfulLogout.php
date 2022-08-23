<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Loguot $event)
    {
        try {

            LoginActivity::create([
                'type'          =>  'Logged Out',
                'user_id'       =>  $event->user->id,
                'ip_address'    =>  \Illuminate\Support\Facades\Request::ip(),
                'user_agent'    =>  \Illuminate\Support\Facades\Request::header('User-Agent')
            ]);

        } catch (\Exception $e) {
            Log::error($e);
        }
    }
}
