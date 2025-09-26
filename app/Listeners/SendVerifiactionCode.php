<?php

namespace App\Listeners;

use App\Events\CustomerRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;


class SendVerifiactionCode
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
    public function handle(CustomerRegistered $event): void
    {
        $customer = $event->customer;
        $code = rand(1000, 9999);
        $customer->verification_code = $code;
        $customer->verification_code_sent_at = now();
        $customer->save();

        $to = preg_replace('/[^0-9]/', '', $customer->phone_number) . '@c.us';

        $params = [
            'token' => env('ULTRAMSG_TOKEN'),
            'to' => $to,
            'body' => "Your verification code is: {$code}"
        ];

        $url = "https://api.ultramsg.com/" . env('ULTRAMSG_INSTANCE_ID') . "/messages/chat";

        $response = Http::asForm()->post($url, $params);

        \Log::info('Sending WhatsApp message', [
            'url' => $url,
            'params' => $params,
            'response' => $response->json()
        ]);

    }
}
