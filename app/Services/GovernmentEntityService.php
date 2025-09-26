<?php

namespace App\Services;

use App\Models\GovernmentEntity;

class GovernmentEntityService extends BaseService
{

    public function __construct()
    {
        $this->model = GovernmentEntity::class ;
    }

    public function getAll($search = null)
    {
        return $this->model::with($this->withRelations())
            ->when($search, function ($query, $search) {
                $query->where('name->en', 'like', "%{$search}%")
                ->orWhere('name->ar', 'like', "%{$search}%");
            })
            ->get();
    }

}