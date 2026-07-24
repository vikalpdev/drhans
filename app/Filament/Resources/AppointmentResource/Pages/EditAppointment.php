<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Concerns\RedirectsToIndexAfterSave;
use App\Filament\Resources\AppointmentResource;
use Filament\Resources\Pages\EditRecord;

class EditAppointment extends EditRecord
{
    use RedirectsToIndexAfterSave;

    protected static string $resource = AppointmentResource::class;
}
