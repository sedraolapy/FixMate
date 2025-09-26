<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use App\Models\Scopes\ActiveScope;
use App\Models\Tag;
use Filament\Resources\Pages\Page;

class TagDetails extends Page
{
    public ?Tag $tag = null;

    public function mount($record): void
    {
        $this->tag = Tag::withoutGlobalScope(ActiveScope::class)
        ->with('serviceProviders')->findOrFail($record);
    }

    public static function getRoute(): string
{
    return '/{record}/details';
}

    protected static string $resource = TagResource::class;

    protected static string $view = 'filament.resources.tag-resource.pages.tag-details';
}
