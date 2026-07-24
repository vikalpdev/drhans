<?php

namespace App\Filament\Resources\SpecialistReviewResource\Pages;

use App\Filament\Concerns\RedirectsToIndexAfterSave;
use App\Filament\Resources\SpecialistReviewResource;
use Filament\Resources\Pages\EditRecord;

class EditSpecialistReview extends EditRecord
{
    use RedirectsToIndexAfterSave;

    protected static string $resource = SpecialistReviewResource::class;
}
