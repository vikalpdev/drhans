<?php

namespace App\Filament\Concerns;

trait RedirectsToIndexAfterSave
{
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
