<?php

namespace App\Filament\Resources\SpecialistResource\Pages;

use App\Filament\Concerns\RedirectsToIndexAfterSave;
use App\Filament\Resources\SpecialistResource;
use Filament\Resources\Pages\EditRecord;

class EditSpecialist extends EditRecord
{
    use RedirectsToIndexAfterSave;

    protected static string $resource = SpecialistResource::class;
}
