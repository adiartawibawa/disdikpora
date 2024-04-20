<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Models\PageMenu;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['organisation_id'] = auth()->user()->organisation_id;

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $page = static::getModel()::create($data);

        PageMenu::create([
            'title' => $page->title,
            'url' => config('app.url') . $page->slug
        ]);

        return $page;
    }
}
