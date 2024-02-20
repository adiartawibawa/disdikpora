<?php

namespace App\Filament\Resources\SarprasTanahResource\Pages;

use App\Filament\Resources\SarprasTanahResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSarprasTanah extends ViewRecord
{
    protected static string $resource = SarprasTanahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
