<?php

namespace App\Filament\Resources\SliderResource\Pages;

use App\Filament\Resources\SliderResource;
use App\Models\Slider;
use Filament\Resources\Pages\Page;

class SliderDetails extends Page
{

    public ?Slider $slider = null;

    public function mount($record): void
    {
        $this->slider = Slider::with('serviceProvider')->findOrFail($record);
    }

    public static function getRoute(): string
{
    return '/{record}/details';
}

    protected static string $resource = SliderResource::class;

    protected static string $view = 'filament.resources.slider-resource.pages.slider-details';
}
