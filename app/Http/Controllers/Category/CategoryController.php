<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $categoryService ;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService ;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $tagId = $request->input('tag');

        $categories = $this->categoryService->getAll($search, $tagId);
        $tags = Tag::all();
        
        return view('categories.index', compact('categories', 'tags'));
    }

    public function show($id)
    {
        $category = $this->categoryService->getById($id);
        return view('categories.show', compact('category'));
    }

}
