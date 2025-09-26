<?php

namespace App\Filament\Resources\ServiceProviderRequestResource\Widgets;

use App\Models\ServiceProviderRequest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalJoinUsStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pending Join Us Requests', ServiceProviderRequest::where('status', 'pending')->count())
                ->description('Awaiting review')
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Approved Join Us Requests', ServiceProviderRequest::where('status', 'approved')->count())
                ->description('Accepted as providers')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Rejected Join Us Requests', ServiceProviderRequest::where('status', 'rejected')->count())
                ->description('Declined applications')
                ->icon('heroicon-o-x-circle')
                ->color('danger'),
        ];

    }
}
