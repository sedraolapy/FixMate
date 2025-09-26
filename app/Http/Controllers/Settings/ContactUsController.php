<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\contactUsRequest;
use App\Models\Admin;
use App\Models\ContactRequest;
use App\Notifications\ContactUsSubmitted;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function show()
{
    $user = Auth('customer')->user();
    return view('contact-us', compact('user'));
}

public function submit(contactUsRequest $request)
{
    $data = $request->validated();


    $feedback = ContactRequest::create($data);
    
    $admins = Admin::all();
    ContactUsSubmitted::createForRecipients($feedback->id, $admins);

    return back()->with('status', 'Your message has been sent successfully.');
}


}
