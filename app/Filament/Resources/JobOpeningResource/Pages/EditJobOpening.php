<?php

namespace App\Filament\Resources\JobOpeningResource\Pages;

use App\Filament\Concerns\RedirectsToIndexAfterSave;
use App\Filament\Resources\JobOpeningResource;
use Filament\Resources\Pages\EditRecord;

class EditJobOpening extends EditRecord
{
    use RedirectsToIndexAfterSave;

    protected static string $resource = JobOpeningResource::class;
}
