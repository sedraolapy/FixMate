<?php

namespace App\Http\Controllers\SubCategory;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Services\SubCategoryService;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $subCategoryService ;

    public function __construct(SubCategoryService $subCategoryService)
    {
        $this->subCategoryService = $subCategoryService ;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $subcategories = $this->subCategoryService->getAll($search);

    return view('subcategories.index', compact('subcategories'));
    }


    public function show($id)
    {
        $sub_category = $this->subCategoryService->getById($id);

        return view('subcategories.show', compact('sub_category'));
    }
}
