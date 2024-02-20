<?php

namespace App\Filament\Resources\DesaResource\Pages;

use App\Filament\Imports\DesaImporter;
use App\Filament\Resources\DesaResource;
use App\Models\Desa;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ManageDesas extends ManageRecords
{
    protected static string $resource = DesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus-circle'),

            Actions\ImportAction::make()
                ->label('Import')
                ->icon('heroicon-o-arrow-down-tray')
                ->importer(DesaImporter::class),
            Action::make('importMaps')
                ->label('Import Map')
                ->form([
                    FileUpload::make('geojson')
                        ->storeFiles(),
                ])
                ->action(function (array $data) {
                    $fileJson = $data['geojson'];

                    $result = $this->importingGeoJson($fileJson);

                    if ($result['success']) {
                        Storage::delete('public/' . $fileJson);
                        return Notification::make()
                            ->title('Disimpan')
                            ->success()
                            ->body('Impor data GeoJSON berhasil.');
                    } else {
                        Storage::delete('public/' . $fileJson);
                        return Notification::make()
                            ->title('Gagal')
                            ->danger()
                            ->body('Impor data GeoJSON gagal. Kesalahan: ' . $result['error']);
                    }
                })
        ];
    }

    public function importingGeoJson($filePath)
    {
        $result = ['success' => false, 'error' => ''];

        try {
            $data = json_decode(Storage::get('public/' . $filePath));
            $features = $data->features;

            foreach ($features as $feature) {
                $code = $feature->properties->FID_BIDANG;
                $geometry = $feature->geometry;

                $desa = Desa::where('code', $code)->first();

                if ($desa) {
                    $meta = json_decode($desa->meta, true);
                    $meta['geometry'] = $geometry;
                    $desa->meta = json_encode($meta);
                    $desa->save();
                }
            }

            $result['success'] = true;
        } catch (\Exception $e) {
            Log::error("Error: " . $e->getMessage());
            $result['error'] = $e->getMessage();
        }

        return $result;
    }
}
