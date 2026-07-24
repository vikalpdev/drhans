<?php

namespace App\Filament\Resources\SpecialistTypeResource\Pages;

use App\Filament\Concerns\RedirectsToIndexAfterSave;
use App\Filament\Resources\SpecialistTypeResource;
use Filament\Resources\Pages\EditRecord;

class EditSpecialistType extends EditRecord
{
    use RedirectsToIndexAfterSave;

    protected static string $resource = SpecialistTypeResource::class;
}
