<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\Scopes\ActiveScope;
use Filament\Resources\Pages\Page;

class CustomerDetails extends Page
{
    public ?Customer $customer = null;

    public function mount($record): void
    {
        $this->customer = Customer::withoutGlobalScope(ActiveScope::class)
        ->findOrFail($record);
    }

    public static function getRoute(): string
{
    return '/{record}/details';
}

    protected static string $resource = CustomerResource::class;

    protected static string $view = 'filament.resources.customer-resource.pages.customer-details';
}
