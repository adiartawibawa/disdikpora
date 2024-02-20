<?php

namespace App\Filament\Resources\SarprasRuangResource\Pages;

use App\Filament\Resources\SarprasRuangResource;
use App\Filament\Resources\SarprasRuangResource\Widgets\KondisiRuanganOverview;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSarprasRuang extends EditRecord
{
    protected static string $resource = SarprasRuangResource::class;

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
            KondisiRuanganOverview::class,
        ];
    }
}
