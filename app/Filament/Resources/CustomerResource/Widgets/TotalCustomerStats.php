<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use App\Models\Customer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalCustomerStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Customers', Customer::count())
                ->description('All registered customers')
                ->icon('heroicon-o-user-group')
                ->color('primary'),
            Stat::make('Total Suspended Customers', Customer::where('status','suspended')->count())
                ->description('All suspended customers')
                ->icon('heroicon-o-user-group')
                ->color('warning'),
        ];

    }
}
