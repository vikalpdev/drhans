<?php

namespace App\Filament\Resources\SpecialistTypeResource\Pages;

use App\Filament\Resources\SpecialistTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpecialistType extends EditRecord
{
    protected static string $resource = SpecialistTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
