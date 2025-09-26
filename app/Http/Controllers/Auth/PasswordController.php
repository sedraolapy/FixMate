<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\changePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(changePasswordRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (!Hash::check($data['current_password'], $request->user()->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
        $request->user()->update([
            'password' => Hash::make($data['password']),
        ]);

        Auth::logout();

        return redirect()->route('login')->with('status', 'Password changed successfully. Please log in again.');

    }
}
