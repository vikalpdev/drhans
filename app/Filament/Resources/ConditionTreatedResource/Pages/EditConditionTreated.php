<?php

namespace App\Filament\Resources\ConditionTreatedResource\Pages;

use App\Filament\Concerns\RedirectsToIndexAfterSave;
use App\Filament\Resources\ConditionTreatedResource;
use Filament\Resources\Pages\EditRecord;

class EditConditionTreated extends EditRecord
{
    use RedirectsToIndexAfterSave;

    protected static string $resource = ConditionTreatedResource::class;
}
