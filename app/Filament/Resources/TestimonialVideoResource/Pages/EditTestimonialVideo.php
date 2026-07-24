<?php

namespace App\Filament\Resources\TestimonialVideoResource\Pages;

use App\Filament\Concerns\RedirectsToIndexAfterSave;
use App\Filament\Resources\TestimonialVideoResource;
use Filament\Resources\Pages\EditRecord;

class EditTestimonialVideo extends EditRecord
{
    use RedirectsToIndexAfterSave;

    protected static string $resource = TestimonialVideoResource::class;
}
