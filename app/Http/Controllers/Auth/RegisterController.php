<?php

namespace App\Http\Controllers\Auth;

use App\Enums\CityStatusEnum;
use App\Enums\CustomerStatusEnum;
use App\Enums\StateStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Register\StoreCustomerRequest;
use App\Models\City;
use App\Models\Customer;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        $cities = City::where('status',CityStatusEnum::ACTIVE->value)->get();
        $states = State::where('status',StateStatusEnum::ACTIVE->value)->get();
        return view('auth.register', compact('cities','states'));
    }

    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }


    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        $data= $request->validated();

        $user = Customer::create([
            'first_name'   => $data['first_name'],
            'last_name'    => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'state_id'     => $data['state_id'],
            'city_id'      => $data['city_id'],
            'password'     => Hash::make($data['password']),
            'status'       =>CustomerStatusEnum::INACTIVE,
        ]);

        // Auth::login($user);

        return redirect()->route('verification.page');
    }
}
