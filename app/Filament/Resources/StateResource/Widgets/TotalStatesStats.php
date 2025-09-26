<?php

namespace App\Filament\Resources\StateResource\Widgets;

use App\Models\State;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalStatesStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Active States', State::where('status', 'active')->count())
                ->description('States currently active')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Inactive States', State::where('status', 'inactive')->count())
                ->description('States currently inactive')
                ->icon('heroicon-o-clock')
                ->color('danger'),

        ];

    }
}
