<?php

namespace App\Filament\Resources\SarprasBangunanResource\Pages;

use App\Filament\Resources\SarprasBangunanResource;
use App\Filament\Resources\SarprasBangunanResource\Widgets\BangunanOverview;
use App\Filament\Resources\SarprasBangunanResource\Widgets\KondisiBangunanOverview;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSarprasBangunan extends ViewRecord
{
    protected static string $resource = SarprasBangunanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            KondisiBangunanOverview::class,
        ];
    }
}
