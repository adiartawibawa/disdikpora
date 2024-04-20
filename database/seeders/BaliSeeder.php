<?php

namespace Database\Seeders;

use App\Helpers\CsvToArray;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Province Seeder
        $provinsis = new CsvToArray();
        $file_provinsis = __DIR__ . '/../../resources/csv/provinsi.csv';
        $header_provinsis = ['code', 'name', 'lat', 'lon'];
        $data_provinsis = $provinsis->csv_to_array($file_provinsis, $header_provinsis);
        $data_provinsis = array_map(function ($arr) use ($now) {
            $arr['meta'] = json_encode(['lat' => $arr['lat'], 'lon' => $arr['lon']]);
            unset($arr['lat'], $arr['lon']);

            return $arr + ['created_at' => $now, 'updated_at' => $now];
        }, $data_provinsis);

        DB::table('provinsis')->insertOrIgnore($data_provinsis);

        // Cities Seeder
        $cities = new CsvToArray();
        $file_cities = __DIR__ . '/../../resources/csv/kabupaten.csv';
        $header_cities = ['code', 'provinsi_code', 'name', 'lat', 'lon'];
        $data_cities = $cities->csv_to_array($file_cities, $header_cities);
        $data_cities = array_map(function ($arr) use ($now) {
            $arr['meta'] = json_encode([
                'lat' => $arr['lat'],
                'lon' => $arr['lon']
            ]);

            unset($arr['lat'], $arr['lon']);

            return $arr + ['created_at' => $now, 'updated_at' => $now];
        }, $data_cities);

        $collection_cities = collect($data_cities);
        foreach ($collection_cities->chunk(50) as $chunk) {
            DB::table('kabupatens')->insertOrIgnore($chunk->toArray());
        }

        // Districts
        $districts = new CsvToArray();
        $file_districts = __DIR__ . '/../../resources/csv/kecamatan.csv';
        $header_districts = ['code', 'kabupaten_code', 'name', 'lat', 'lon'];
        $data_districts = $districts->csv_to_array($file_districts, $header_districts);
        $data_districts = array_map(function ($arr) use ($now) {
            $arr['meta'] = json_encode(['lat' => $arr['lat'], 'lon' => $arr['lon']]);
            unset($arr['lat'], $arr['lon']);

            return $arr + ['created_at' => $now, 'updated_at' => $now];
        }, $data_districts);

        $collection_districts = collect($data_districts);
        foreach ($collection_districts->chunk(50) as $chunk) {
            DB::table('kecamatans')->insertOrIgnore($chunk->toArray());
        }

        // Villages Seeder
        $villages = new CsvToArray();
        $file_villages = __DIR__ . '/../../resources/csv/desa.csv';
        $header_villages = ['code', 'kecamatan_code', 'name', 'lat', 'lon', 'kode_pos', 'luas_ha', 'no_perbup', 'geometry', 'coordinates'];
        $data_villages = $villages->csv_to_array($file_villages, $header_villages);
        $data_villages = array_map(function ($arr) use ($now) {
            $arr['meta'] = json_encode([
                'lat' => $arr['lat'],
                'lon' => $arr['lon'],
                'kode_pos' => $arr['kode_pos'],
                'luas_ha' => $arr['luas_ha'],
                'no_perbup' => $arr['no_perbup'],
                'geometry' => $arr['geometry'],
                'coordinates' => $arr['coordinates'],
            ]);

            unset($arr['lat'], $arr['lon'], $arr['kode_pos'], $arr['luas_ha'], $arr['no_perbup'], $arr['geometry'], $arr['coordinates']);

            return $arr + ['created_at' => $now, 'updated_at' => $now];
        }, $data_villages);

        $collection_villages = collect($data_villages);
        foreach ($collection_villages->chunk(50) as $chunk) {
            DB::table('desas')->insertOrIgnore($chunk->toArray());
        }
    }
}
