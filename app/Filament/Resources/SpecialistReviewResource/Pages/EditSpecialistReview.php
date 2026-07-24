<?php

namespace App\Filament\Resources\SpecialistReviewResource\Pages;

use App\Filament\Concerns\RedirectsToIndexAfterSave;
use App\Filament\Resources\SpecialistReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpecialistReview extends EditRecord
{
    use RedirectsToIndexAfterSave;

    protected static string $resource = SpecialistReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
