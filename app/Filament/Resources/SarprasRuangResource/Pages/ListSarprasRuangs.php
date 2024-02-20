<?php

namespace App\Filament\Resources\SarprasRuangResource\Pages;

use App\Filament\Resources\SarprasRuangResource;
use App\Filament\Resources\SarprasRuangResource\Widgets\RuanganOverview;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListSarprasRuangs extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = SarprasRuangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            RuanganOverview::class,
        ];
    }
}
