<?php

namespace App\Http\Controllers\Auth;

use App\Enums\CityStatusEnum;
use App\Enums\CustomerStatusEnum;
use App\Enums\StateStatusEnum;
use App\Events\CustomerRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Register\StoreCustomerRequest;
use App\Models\City;
use App\Models\Customer;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    $translatedCities = $cities->map(function ($city) {
        return [
            'id' => $city->id,
            'name' => $city->getTranslation('name', app()->getLocale()),
        ];
    });

    return response()->json($translatedCities);
}


    public function store(StoreCustomerRequest $request): RedirectResponse
{
    $data = $request->validated();

    if (Customer::where('phone_number', $data['phone_number'])->exists()) {
        return redirect()->back()
            ->withErrors(['phone_number' => 'This phone number is already in use.'])
            ->withInput();
    }

    DB::beginTransaction();

    try {
        $customer = Customer::create([
            'first_name'   => $data['first_name'],
            'last_name'    => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'state_id'     => $data['state_id'],
            'city_id'      => $data['city_id'],
            'password'     => Hash::make($data['password']),
            'status'       => CustomerStatusEnum::INACTIVE,
        ]);

        event(new CustomerRegistered($customer));

        $customer->assignRole('customer');

        DB::commit();

        return redirect()->route('verification.notice', [
            'customer_id' => $customer->id
        ]);
    } catch (\Throwable $e) {
        DB::rollBack();

        return redirect()->back()
            ->withErrors(['error' => 'Something went wrong. Please try again.'])
            ->withInput();
    }

}

}
