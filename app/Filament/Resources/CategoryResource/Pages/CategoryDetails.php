<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Models\Category;
use Filament\Resources\Pages\Page;

class CategoryDetails extends Page
{

    public ?Category $category = null;

    public function mount($record): void
    {
        $this->category = Category::with('subcategories')->findOrFail($record);
    }

    public static function getRoute(): string
{
    return '/{record}/details';
}

    protected static string $resource = CategoryResource::class;

    protected static string $view = 'filament.resources.category-resource.pages.gategory-details';
}
