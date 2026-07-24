<?php

namespace App\Filament\Resources\TreatmentResource\Pages;

use App\Filament\Concerns\RedirectsToIndexAfterSave;
use App\Filament\Resources\TreatmentResource;
use Filament\Resources\Pages\EditRecord;

class EditTreatment extends EditRecord
{
    use RedirectsToIndexAfterSave;

    protected static string $resource = TreatmentResource::class;
}
