<?php

namespace App\Http\Controllers\Auth;

use App\Events\CustomerRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyCustomer\VerificationRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class VerificationController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function verifyPrompt(Request $request, $customer_id): RedirectResponse|View
    {
        $customer = Customer::where('id',$customer_id)->first();
        return view('auth.verify-phone-number', compact('customer'));
    }

    public function verify(VerificationRequest $request, $customer_id){
        $data = $request->validated();
        $customer = Customer::where('id', $customer_id)->first();

        if($customer->verified_at){
            return redirect()->back()->withErrors(['verification_code' => 'You already verified! Try to login.']);
        }

        if (!$customer->verification_code_sent_at ||Carbon::parse($customer->verification_code_sent_at)->diffInHours(now()) > 48) {
            $customer->verification_code = null ;
            $customer->verification_code_sent_at = null ;
            $customer->save();
            return back()->withErrors(['verification_code' => 'This code has expired. Please request a new one.']);
        }


        if($data['verification_code'] == $customer->verification_code){
            $customer->verified_at = now();
            $customer->save();

            return redirect()->route('login');
        }

        return redirect()->back()->withErrors(['verification_code' => 'The code is not correct!']);
    }

    public function resendCode($customer_id){
        $customer = Customer::where('id', $customer_id)->first();

        $cacheKey = 'resend_count_' . $customer->id;
        $resendData = Cache::get($cacheKey, [
            'count' => 0,
            'start_time' => now(),
        ]);

        // Reset count if 24 hours passed
        if (Carbon::parse($resendData['start_time'])->diffInHours(now()) >= 24) {
            $resendData = [
                'count' => 0,
                'start_time' => now(),
            ];
        }

        // Check if resend limit reached
        if ($resendData['count'] >= 3) {
            \Log::warning('Resend limit reached for customer ID: ' . $customer->id);
            return redirect()->back()->withErrors(['verification_code' => 'to any attempts, please try again.']);
        }

        event(new CustomerRegistered($customer));

        $resendData['count']++;
        Cache::put($cacheKey, $resendData, now()->addHours(24));

        return redirect()->back()->withErrors(['verification_code' => 'The code is sent successfully!']);
    }


}
