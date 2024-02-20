<?php

namespace App\Filament\Resources\SarprasBangunanResource\Pages;

use App\Filament\Resources\SarprasBangunanResource;
use App\Filament\Resources\SarprasBangunanResource\Widgets\BangunanOverview;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListSarprasBangunans extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = SarprasBangunanResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            BangunanOverview::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
