<?php

namespace App\Listeners;

use App\Events\ServiceProviderApplication;
use App\Mail\ProviderApplicationMail;
use App\Models\Admin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class sendApplicationForm
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ServiceProviderApplication $event): void
    {
        $admin = Admin::first();

        if ($admin) {
            Mail::to($admin->email)->send(new ProviderApplicationMail($event->data));
        }


    }
}
