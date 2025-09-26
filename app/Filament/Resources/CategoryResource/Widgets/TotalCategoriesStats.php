<?php

namespace App\Filament\Resources\CategoryResource\Widgets;

use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalCategoriesStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Active Categories', Category::where('status', 'active')->count())
                ->description('Currently active categories')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Inactive Categories', Category::where('status', 'inactive')->count())
                ->description('Currently inactive categories')
                ->icon('heroicon-o-archive-box')
                ->color('danger'),
        ];
    }
}
