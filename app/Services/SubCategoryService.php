<?php

namespace App\Services;

use App\Models\SubCategory;

class SubCategoryService extends BaseService
{

    public function __construct()
    {
        $this->model = SubCategory::class ;
    }

    protected function withRelations()
    {
    return ['serviceProviders', 'category'];
    }

    public function getAll($search = null)
    {
        return $this->model::with($this->withRelations())
            ->where('name->ar', 'like', "%{$search}%")
            ->orWhere('name->en', 'like', "%{$search}%")
            ->orWhereHas('serviceProviders.tags', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->get();
    }


}
