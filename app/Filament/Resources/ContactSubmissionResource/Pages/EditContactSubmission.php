<?php

namespace App\Filament\Resources\ContactSubmissionResource\Pages;

use App\Filament\Concerns\RedirectsToIndexAfterSave;
use App\Filament\Resources\ContactSubmissionResource;
use Filament\Resources\Pages\EditRecord;

class EditContactSubmission extends EditRecord
{
    use RedirectsToIndexAfterSave;

    protected static string $resource = ContactSubmissionResource::class;
}
