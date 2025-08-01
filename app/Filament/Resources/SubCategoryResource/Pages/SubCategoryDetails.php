<?php

namespace App\Filament\Resources\SubCategoryResource\Pages;

use App\Filament\Resources\SubCategoryResource;
use App\Models\SubCategory;
use Filament\Resources\Pages\Page;

class SubCategoryDetails extends Page
{
    public ?SubCategory $subCategory = null;

    public function mount($record): void
    {
        $this->subCategory = SubCategory::with('category')->findOrFail($record);
    }

    public static function getRoute(): string
{
    return '/{record}/details';
}

    protected static string $resource = SubCategoryResource::class;

    protected static string $view = 'filament.resources.sub-category-resource.pages.sub-category-details';
}
