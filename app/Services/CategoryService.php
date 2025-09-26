<?php

namespace App\Services;

use App\Models\Category;

class CategoryService extends BaseService
{

    public function __construct()
    {
        $this->model = Category::class ;
    }

    protected function withRelations()
    {
    return ['subcategories'];
    }

    public function getAll($search = null, $tagId = null)
    {
        return $this->model::with($this->withRelations())
            ->when($search, function ($query, $search) {
                $query->where('name->en', 'like', "%{$search}%")
                    ->orWhere('name->ar', 'like', "%{$search}%")
                    ->orWhereHas('subcategories', function ($subQuery) use ($search) {
                        $subQuery->where('name->en', 'like', "%{$search}%")
                                ->orWhere('name->ar', 'like', "%{$search}%");
                    });
            })
            ->when($tagId, function ($query) use ($tagId) {
                $query->tagFilter($tagId);
            })
            ->get();
    }




}