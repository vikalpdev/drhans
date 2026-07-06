<?php

namespace App\Filament\Resources\ConditionTreatedResource\Pages;

use App\Filament\Resources\ConditionTreatedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConditionTreated extends EditRecord
{
    protected static string $resource = ConditionTreatedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
