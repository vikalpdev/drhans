<?php

namespace App\Filament\Resources\SpecialistReviewResource\Pages;

use App\Filament\Resources\SpecialistReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpecialistReviews extends ListRecords
{
    protected static string $resource = SpecialistReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
