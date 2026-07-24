<?php

namespace App\Filament\Resources\SpecialistTypeResource\Pages;

use App\Filament\Resources\SpecialistTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpecialistTypes extends ListRecords
{
    protected static string $resource = SpecialistTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
