<?php

namespace App\Http\Controllers\GovernmentEntity;

use App\Http\Controllers\Controller;
use App\Models\GovernmentEntity;
use App\Services\GovernmentEntityService;
use Illuminate\Http\Request;

class GovernmentEntityController extends Controller
{
    protected $governmentEntityService ;

    public function __construct(GovernmentEntityService $governmentEntityService)
    {
        $this->governmentEntityService = $governmentEntityService ;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $entities = $this->governmentEntityService->getAll($search);

        return view('entities.index', compact('entities'));
    }


}
