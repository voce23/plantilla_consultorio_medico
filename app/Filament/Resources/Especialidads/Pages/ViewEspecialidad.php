<?php

namespace App\Filament\Resources\Especialidads\Pages;

use App\Filament\Resources\Especialidads\EspecialidadResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEspecialidad extends ViewRecord
{
    protected static string $resource = EspecialidadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
