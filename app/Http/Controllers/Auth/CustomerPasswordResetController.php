<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\forgetPasswordRequest;
use App\Http\Requests\Auth\resetPasswordRequest;
use App\Http\Requests\Auth\verifyPasswordCodeRequest;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class CustomerPasswordResetController extends Controller
{

    public function create()
{
    return view('auth.forgot-password');
}

    public function sendCode(forgetPasswordRequest $request)
{
    $data = $request->validated();

    $customer = Customer::where('phone_number', $request->phone_number)->first();

    if (!$customer) {
        return back()->withErrors(['phone_number' => 'Phone number not found']);
    }

    $code = rand(100000, 999999);
    $customer->update([
        'verification_code' => $code,
        'verification_code_sent_at' => Carbon::now()
    ]);
    $customer->save();

    $to = preg_replace('/[^0-9]/', '', $customer->phone_number) . '@c.us';

    $params = [
        'token' => env('ULTRAMSG_TOKEN'),
        'to' => $to,
        'body' => "Your verification code is: {$code}"
    ];

    $url = "https://api.ultramsg.com/" . env('ULTRAMSG_INSTANCE_ID') . "/messages/chat";

    $response = Http::asForm()->post($url, $params);

    return redirect()->route('verify.code.form', [
        'phone_number' => $customer->phone_number
    ])->with('status', 'Verification code sent via WhatsApp');
}

public function showVerifyForm(Request $request) {
    return view('auth.verify-code', [
        'phone_number' => $request->phone_number,
        'status' => session('status')
    ]);
}


public function verifyCode(verifyPasswordCodeRequest $request)
{
    $data = $request->validated();

    $customer = Customer::where('phone_number', $data['phone_number'])
        ->where('verification_code', $data['verification_code'])->first();

    if (!$customer || Carbon::parse($customer->verification_code_sent_at)->addMinutes(15)->isPast()) {
        return back()->withErrors(['verification_code' => 'Invalid or expired code']);
    }

    return view('auth.reset-password-phone', ['phone_number' => $data['phone_number']]);
}


public function resetPassword(resetPasswordRequest $request)
{
    $data = $request->validated();

    $customer = Customer::where('phone_number', $data['phone_number'])->first();

    if (!$customer) {
        return back()->withErrors(['phone_number' => 'Customer not found']);
    }

    $customer->update([
        'password' => Hash::make($data['password']),
        'verification_code' => null,
        'verification_code_sent_at' => null
    ]);
    $customer->save();

    return redirect()->route('login')->with('status', 'Password reset successful');
}



}
