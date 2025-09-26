<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function show()
    {
        $privacy_policies = PrivacyPolicy::where('is_active',true)->get();
        return view('privacy-policy',compact('privacy_policies'));
    }

}
