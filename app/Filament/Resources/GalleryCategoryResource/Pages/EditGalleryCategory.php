<?php

namespace App\Filament\Resources\GalleryCategoryResource\Pages;

use App\Filament\Concerns\RedirectsToIndexAfterSave;
use App\Filament\Resources\GalleryCategoryResource;
use Filament\Resources\Pages\EditRecord;

class EditGalleryCategory extends EditRecord
{
    use RedirectsToIndexAfterSave;

    protected static string $resource = GalleryCategoryResource::class;
}
