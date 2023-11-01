<?php

namespace App\Livewire\Components\Maps;

use App\Models\Sekolah;
use Livewire\Component;

class SchoolMarker extends Component
{

    public function render()
    {
        return view('livewire.components.maps.school-marker', [
            'sekolah' => $this->makeGeoJson()
        ]);
    }

    public function getAllSchool()
    {
        $sekolah = Sekolah::with(['village'])->get();

        return $sekolah;
    }

    public function makeGeoJson()
    {
        $sekolah = $this->getAllSchool();

        $geojsonFeatures = $sekolah->map(function ($item) {
            return [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$item->lokasi->longitude, $item->lokasi->latitude],
                ],
                'properties' => [
                    'id' => $item->id,
                    'name' => $item->nama,
                    'status' => $item->status,
                    // Tambahkan atribut lain sesuai kebutuhan
                ],
            ];
        });

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => $geojsonFeatures,
        ];

        $geojson = json_encode($geojson, JSON_NUMERIC_CHECK);

        // dd($geojson);
        return $geojson;
    }
}
