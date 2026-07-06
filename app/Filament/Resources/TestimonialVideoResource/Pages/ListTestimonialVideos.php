<?php

namespace App\Filament\Resources\TestimonialVideoResource\Pages;

use App\Filament\Resources\TestimonialVideoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestimonialVideos extends ListRecords
{
    protected static string $resource = TestimonialVideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
