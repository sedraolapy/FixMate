<?php

namespace App\Http\Controllers\Auth;

use App\Enums\CustomerStatusEnum;
use App\Events\CustomerRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Customer;
use App\Models\Scopes\ActiveScope;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }


    /**
     * Handle an incoming authentication request.
     */

        public function store(LoginRequest $request)
        {
            $data = $request->validated();

            $customer = Customer::withoutGlobalScope(ActiveScope::class)->where('phone_number',$data['phone_number'])->first();

            if (!$customer) {
                return back()->withErrors([
                    'phone_number' => 'No account found with this phone number.',
                ])->withInput();
            }


            if (!Hash::check($data['password'], $customer->password)) {
                return back()->withErrors([
                    'phone_number' => 'Invalid phone number or password.',
                ])->withInput();
            }


            if (is_null($customer->verified_at)) {
                event(new CustomerRegistered($customer));
                return redirect()->route('verification.notice', ['customer_id' => $customer->id])
                ->with('info', 'Please verify your account before logging in.');
            }

            if ($customer->status === CustomerStatusEnum::SUSPENDED) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'phone_number' => __('Your account is suspended. Contact the admin.'),
                ]);
            }

            Auth::guard('customer')->login($customer);
            $request->session()->regenerate();
            session(['customer_id' => $customer->id]);

            return redirect()->intended(route('dashboard'))->with('success', 'User logged in successfully.');


        }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
