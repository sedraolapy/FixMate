<?php

namespace App\Filament\Resources\StateResource\Pages;

use App\Filament\Resources\StateResource;
use App\Models\Scopes\ActiveScope;
use App\Models\State;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Builder;

class StateDetails extends Page
{

    public ?State $state = null;


    public function mount($record): void
    {
        $this->state = State::with('cities')->withoutGlobalScope(ActiveScope::class)->findOrFail($record);
    }

    public static function getRoute(): string
{
    return '/{record}/details';
}

    protected static string $resource = StateResource::class;

    protected static string $view = 'filament.resources.state-resource.pages.state-details';


}
