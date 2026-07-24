<?php

namespace App\Filament\Resources\GalleryItemResource\Pages;

use App\Filament\Concerns\RedirectsToIndexAfterSave;
use App\Filament\Resources\GalleryItemResource;
use Filament\Resources\Pages\EditRecord;

class EditGalleryItem extends EditRecord
{
    use RedirectsToIndexAfterSave;

    protected static string $resource = GalleryItemResource::class;
}
