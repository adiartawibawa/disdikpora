<?php

namespace App\Livewire\Welcome\Sekolah;

use App\Models\Sekolah;
use Livewire\Component;
use Illuminate\Support\Str;

class PetaSekolah extends Component
{
    public $lat = '-8.4644416';
    public $lon = '115.2808069';
    public $zoom = '13';
    public $negeriIcon;
    public $swastaIcon;
    public $shadowIcon;

    public function mount()
    {
        $this->negeriIcon = asset('/img/icon/school-negeri.png');
        $this->swastaIcon = asset('/img/icon/school-swasta.png');
        $this->shadowIcon = asset('/img/icon/school-shadow.png');
    }
    public function getAllSchool()
    {
        $sekolah = Sekolah::with(['village.district'])->get();

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
                    'npsn' => $item->npsn,
                    'status' => ucwords($item->status),
                    'alamat' => $item->alamat,
                    'kode_pos' => $item->village->first()->meta['pos'],
                    'desa' => ucwords(Str::lower($item->village->first()->name)),
                    'kecamatan' => ucwords(Str::lower($item->village->first()->district->name)),
                    'url' => route('detail', $item->id),
                    // 'url' => "\$dispatch('openModal', {component: 'welcome.sekolah.detail-sekolah', arguments: {sekolah: '$item->id'}})",
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


    public function render()
    {
        return view('livewire.welcome.sekolah.peta-sekolah', [
            'sekolah' => $this->makeGeoJson()
        ]);
    }
}
