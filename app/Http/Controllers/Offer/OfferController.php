<?php

namespace App\Http\Controllers\Offer;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Notifications\ServiceOfferCreated;
use App\Services\OfferService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    protected $offerService ;

    public function __construct(OfferService $offerService)
    {
        $this->offerService = $offerService ;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $offers = $this->offerService->getAll($search);

        return view('offers.index', compact('offers'));
    }


}
