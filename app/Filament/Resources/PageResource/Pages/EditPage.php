<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Concerns\RedirectsToIndexAfterSave;
use App\Filament\Resources\PageResource;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    use RedirectsToIndexAfterSave;

    protected static string $resource = PageResource::class;
}
