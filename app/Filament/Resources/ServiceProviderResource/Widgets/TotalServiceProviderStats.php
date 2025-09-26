<?php

namespace App\Filament\Resources\ServiceProviderResource\Widgets;

use App\Enums\ServiceProviderStatusEnum;
use App\Models\ServiceProvider;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalServiceProviderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Active Service Providers', ServiceProvider::where('status', ServiceProviderStatusEnum::ACTIVE->value)->count())
                ->description('Currently offering services')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Inactive Service Providers', ServiceProvider::where('status', ServiceProviderStatusEnum::INACTIVE->value)->count())
                ->description('Not currently active')
                ->icon('heroicon-o-user')
                ->color('gray'),

            Stat::make('Expired Service Providers', ServiceProvider::where('status', ServiceProviderStatusEnum::EXPIRED->value)->count())
                ->description('Expired or outdated profiles')
                ->icon('heroicon-o-clock')
                ->color('danger'),
        ];


    }
}
