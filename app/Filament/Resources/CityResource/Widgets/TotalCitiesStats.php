<?php

namespace App\Filament\Resources\CityResource\Widgets;

use App\Models\City;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalCitiesStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Active Cities', City::where('status', 'active')->count())
                ->description('Cities currently active')
                ->icon('heroicon-o-building-office')
                ->color('success'),

            Stat::make('Inactive Cities', City::where('status', 'inactive')->count())
                ->description('Cities currently inactive')
                ->icon('heroicon-o-x-circle')
                ->color('danger'),
        ];

    }
}
