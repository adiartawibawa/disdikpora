<?php

namespace App\Filament\Resources\SarprasBangunanResource\Pages;

use App\Filament\Resources\SarprasBangunanResource;
use App\Filament\Resources\SarprasBangunanResource\Widgets\KondisiBangunanOverview;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSarprasBangunan extends EditRecord
{
    protected static string $resource = SarprasBangunanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            KondisiBangunanOverview::class,
        ];
    }
}
