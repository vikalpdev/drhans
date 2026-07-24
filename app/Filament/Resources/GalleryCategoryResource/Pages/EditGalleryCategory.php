<?php

namespace App\Filament\Resources\GalleryCategoryResource\Pages;

use App\Filament\Concerns\RedirectsToIndexAfterSave;
use App\Filament\Resources\GalleryCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGalleryCategory extends EditRecord
{
    use RedirectsToIndexAfterSave;

    protected static string $resource = GalleryCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
