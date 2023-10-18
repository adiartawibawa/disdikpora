<?php

namespace App\Imports;

use App\Models\Sekolah;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use MatanYadaev\EloquentSpatial\Objects\Point;

class SekolahsImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return new Sekolah([
            'npsn' => $row['npsn'],
            'nama' => $row['nama_satuan_pendidikan'],
            'jenjang' => strtolower($row['jenjang']),
            'status' => $row['status_sekolah'],
            'alamat' => $row['alamat'],
            'village_code' => $this->getVillageCode($row['kecamatan'], $row['desa']),
            'lokasi' => new Point($row['lintang'], $row['bujur'], Srid::WGS84->value),
        ]);
    }

    public function headingRow(): int
    {
        return 3;
    }

    private function getVillageCode($kecamatan, $desa)
    {

        $village = \Indonesia::search($kecamatan)->allVillages();

        foreach ($village as $item) {
            if ($item->name == strtoupper($desa)) {
                return $item->code;
            }
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
