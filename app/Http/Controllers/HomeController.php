<?php

namespace App\Http\Controllers;

use App\Http\Requests\contactUsRequest;
use App\Models\Category;
use App\Models\GovernmentEntity;
use App\Models\Offer;
use App\Models\ServiceProvider;
use App\Models\Slider;
use App\Services\CategoryService;
use App\Services\GovernmentEntityService;
use App\Services\OfferService;
use App\Services\ServiceProviderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $serviceProviderService , $categoryService , $offerService , $governmentEntityService;

    public function __construct(ServiceProviderService $serviceProviderService, CategoryService $categoryService
    ,OfferService $offerService, GovernmentEntityService $governmentEntityService)
    {
        $this->serviceProviderService = $serviceProviderService ;
        $this->categoryService = $categoryService ;
        $this->offerService = $offerService ;
        $this->governmentEntityService = $governmentEntityService ;
    }

    public function dashboard(Request $request)
    {
        $user = Auth('customer')->user();

        $notifications = collect();
        $unreadCount = 0;
        $search = $request->input('search');

        $categories = $this->categoryService->getAll($search);
        $providers = $this->serviceProviderService->getAll($search);
        $offers = $this->offerService->getAll();
        $sliders = Slider::with('serviceProvider')->get();
        $entities = $this->governmentEntityService->getAll();
        if ($user) {
            $notifications = $user->unreadNotifications()->latest()->take(10)->get();
            $unreadCount = $user->unreadNotifications()->count();
        }

        return view('dashboard', compact('categories', 'providers', 'offers', 'entities', 'sliders' ,
    'notifications', 'unreadCount'));
    }




}
