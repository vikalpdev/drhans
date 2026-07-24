<?php

namespace App\Filament\Resources\CentreResource\Pages;

use App\Filament\Concerns\RedirectsToIndexAfterSave;
use App\Filament\Resources\CentreResource;
use Filament\Resources\Pages\EditRecord;

class EditCentre extends EditRecord
{
    use RedirectsToIndexAfterSave;

    protected static string $resource = CentreResource::class;
}
