<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogFailedLogin
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
    public function handle(Failed $event)
    {
        try {

            if(is_null($event->user)) return 0;

            LoginActivity::create([
                'type'          =>  'Failed Login Attempt',
                'user_id'       =>  $event->user->id,
                'ip_address'    =>  \Illuminate\Support\Facades\Request::ip(),
                'user_agent'    =>  \Illuminate\Support\Facades\Request::header('User-Agent')
            ]);

            if( config('login-activity.multiple_failed_login_attempt_email') == true )
                $this->sendEmailForFailedLoginAttempts($event);

        } catch (\Exception $e) {
            Log::error($e);
        }
    }

}
