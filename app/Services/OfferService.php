<?php

namespace App\Services;

use App\Models\Offer;

class OfferService extends BaseService
{

    public function __construct()
    {
        $this->model = Offer::class ;
    }

    protected function withRelations()
    {
    return ['serviceProvider'];
    }

    public function getAll($search = null)
    {
        return $this->model::with($this->withRelations())
        ->orWhereHas('serviceProvider', function ($q) use ($search) {
            $q->where('shop_name', 'like', "%{$search}%");
        })
        ->get();
    }

}