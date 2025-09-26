<?php

namespace App\Services;

use App\Models\ServiceProvider;

class ServiceProviderService extends BaseService
{

    public function __construct()
    {
        $this->model = ServiceProvider::class ;
    }

    protected function withRelations()
    {
    return ['tags', 'category', 'subcategory', 'state', 'city', 'offers'];
    }

    public function getAll($search = null, $filters = [])
    {
        $query = $this->model::with($this->withRelations())
        ->when($search, function ($query, $search) {
            $query->where('name->ar', 'like', "%{$search}%")
                ->orWhere('name->en', 'like', "%{$search}%")
                ->orWhereHas('tags', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        })
        ->categoryFilter($filters['category'] ?? null)
        ->subCategoryFilter($filters['subcategory'] ?? null)
        ->stateFilter($filters['state'] ?? null)
        ->cityFilter($filters['city'] ?? null)
        ->tagFilter($filters['tag'] ?? null)
        ->sortFilter($filters['sort'] ?? null);

    if (auth('customer')->check()) {
        $userCity = auth('customer')->user()->city_id;
        $query->orderByRaw("city_id = ? DESC", [$userCity]);
    }

    return $query->get();
    }

}