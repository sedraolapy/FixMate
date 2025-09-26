<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Events\ServiceProviderApplication;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceProviderRequests\storeRequest;
use App\Mail\ProviderApplicationMail;
use App\Models\Admin;
use App\Models\Category;
use App\Models\City;
use App\Models\ServiceProvider;
use App\Models\ServiceProviderRequest;
use App\Models\State;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Notifications\ApplyServiceProviderNotification;
use App\Services\ServiceProviderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class ServiceProviderController extends Controller
{

    protected $serviceProviderService ;

    public function __construct(ServiceProviderService $serviceProviderService)
    {
        $this->serviceProviderService = $serviceProviderService ;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $filters = $request->only(['category', 'subcategory', 'state', 'city', 'tag', 'sort']);
        $providers = $this->serviceProviderService->getAll($search, $filters);

        $categories = Category::all();
        $subcategories = SubCategory::all();
        $states = State::all();
        $cities = City::all();
        $tags = Tag::all();

        return view('providers.index', compact('providers', 'categories', 'subcategories', 'states', 'cities', 'tags'));

    }

public function show($id)
{
    $provider = $this->serviceProviderService->getById($id);
    $provider->increment('views');

    return view('providers.show', compact('provider'));
}

    public function create()
    {
        $categories = Category::get();
        $subcategories = SubCategory::get();
        $states = State::get();
        $cities = City::get();
        return view('providers.apply', compact('categories', 'subcategories', 'states', 'cities'));
    }

    public function store(storeRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
            }
            $data['status'] = 'pending';

            $requestRecord = ServiceProviderRequest::create($data);

            $requestRecord->load(['category', 'subcategory', 'state', 'city']);

            // Send email to admin
            event(new ServiceProviderApplication($requestRecord));

            DB::commit();

            return redirect()->back()->with('success', 'Your application has been submitted!');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Service Provider Application Failed: '.$e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Something went wrong, please try again.']);
        }
    }


}
