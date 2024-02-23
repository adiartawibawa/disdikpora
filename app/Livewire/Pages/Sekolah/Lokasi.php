<?php

namespace App\Livewire\Pages\Sekolah;

use App\Models\Sekolah;
use Livewire\Component;

class Lokasi extends Component
{
    protected int $zoomLevel = 10;
    public $lokasi;
    public $geojson;

    public function mount($sekolah)
    {
        $this->lokasi = Sekolah::whereOrganisationId($sekolah)->firstOrFail();
        // Deserialisasi data JSON
        $meta = json_decode($this->lokasi->meta);
        // Tentukan nama file ikon berdasarkan bentuk sekolah
        $iconFileName = 'school-' . strtolower($this->lokasi->bentuk->code) . '.png';

        // Membentuk struktur data GeoJSON
        $feature = [
            'type' => 'Feature',
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [$meta->lon, $meta->lat], // Format [longitude, latitude]
            ],
            'properties' => [
                "npsn" => $this->lokasi->npsn,
                'nama' => $this->lokasi->nama,
                "sekolah_bentuks_code" => $this->lokasi->sekolah_bentuks_code,
                "status" => $this->lokasi->status,
                "alamat" => $this->lokasi->alamat,
                "icon" => asset('icon/' . $iconFileName), // Tambahkan properti icon
                // Masukkan properti tambahan sesuai kebutuhan
            ],
        ];

        // Struktur data fitur GeoJSON dimasukkan ke dalam fitur koleksi GeoJSON
        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [$feature],
        ];

        // Konversi data menjadi format JSON
        $this->geojson = json_encode($geojson);
    }

    public function render()
    {
        return view('livewire.pages.sekolah.lokasi');
    }
}
