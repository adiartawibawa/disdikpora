<?php

namespace Database\Seeders;

use App\Models\Prasarana;
use App\Models\ReferensiRuang;
use App\Models\SarprasBangunan;
use App\Models\SarprasRuang;
use App\Models\SarprasTanah;
use App\Models\Sekolah;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SarprasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prasaranas = Prasarana::defaultJenisPrasarana();

        foreach ($prasaranas as $item) {
            Prasarana::firstOrCreate($item);
        }

        $this->command->info('Default jenis prasarana ditambahkan.');

        $referensis = ReferensiRuang::defaultReferensiRuang();

        foreach ($referensis as $item) {
            ReferensiRuang::firstOrCreate($item);
        }

        $this->command->info('Default referensi ruang ditambahkan.');

        $sekolahs = Sekolah::all();
        $faker = Faker::create();

        foreach ($sekolahs as $sekolah) {
            $panjang = $faker->numberBetween(5, 100);
            $lebar = $faker->numberBetween(5, 50);
            $tanah = SarprasTanah::create([
                'organisation_id' => $sekolah->organisation_id,
                'jenis_prasarana_id' => Prasarana::whereName('Tanah')->first()->id,
                'nama' => 'Tanah ' . $sekolah->nama,
                'no_sertifikat' => 'xx.xx.xx.xx.x.xxxxx',
                'panjang' => $panjang,
                'lebar' => $lebar,
                'luas' => $panjang * $lebar,
                'luas_tersedia' => $panjang * $lebar,
                'kepemilikan' => 'Milik',
                'njop' => 750000
            ]);

            for ($i = 0; $i < 10; $i++) {

                $kode = 'B-0' . $faker->numberBetween(1, 99);
                $p = $faker->numberBetween(5, 50);
                $l = $faker->numberBetween(5, 50);

                $bangunan = SarprasBangunan::create([
                    'organisation_id' => $sekolah->organisation_id,
                    'jenis_prasarana_id' => Prasarana::whereName('Ruang Sirkulasi')->first()->id,
                    'tanah_id' => $tanah->id,
                    'kode_bangunan' => $kode,
                    'nama' => 'Bangunan ' . $kode,
                    'panjang' => $p,
                    'lebar' => $l,
                    'luas_tapak_bangunan' => $p * $l,
                    'kepemilikan' => 'Milik',
                    'peminjam_meminjamkan' => null,
                    'nilai_aset' => null,
                    'jml_lantai' => random_int(1, 3),
                    'tahun_bangun' => $faker->year(),
                    'keterangan' => null,
                    'tanggal_sk_pemakai' => $faker->date(),
                    // 'volume_pondasi' => ,
                    // 'volume_sloop' => ,
                    // 'panjang_kuda' => ,
                    // 'panjang_kaso' => ,
                    // 'panjang_reng' => ,
                    // 'luas_tutup_atap' => ,
                ]);

                for ($j = 0; $j < 6; $j++) {
                    $pj = $faker->numberBetween(5, 10);
                    $lb = $faker->numberBetween(5, 10);
                    $ruang = $referensis[array_rand($referensis)];

                    SarprasRuang::create([
                        'organisation_id' => $sekolah->organisation_id,
                        'referensi_ruang_id' => ReferensiRuang::whereName($ruang['name'])->first()->id,
                        'bangunan_id' => $bangunan->id,
                        'kode_ruang' => 'Ruang ' . $faker->randomDigitNotNull() . '' . $faker->randomLetter(),
                        'nama' => 'Ruang XXX',
                        'registrasi_ruang' => 'XX.XX.XXXX.XX',
                        'lantai_ke' => random_int(1, 3),
                        'panjang' => $pj,
                        'lebar' => $lb,
                        'luas' => $pj * $lb,
                        'kapasitas' => random_int(20, 40),
                        // 'luas_plester',
                        // 'luas_plafond',
                        // 'luas_dinding',
                        // 'luas_daun_jendela',
                        // 'luas_daun_pintu',
                        // 'panjang_kusen',
                        // 'luas_tutup_lantai',
                        // 'luas_instalasi_listrik',
                        // 'jumlah_instalasi_listrik',
                        // 'panjang_instalasi_air',
                        // 'jumlah_instalasi_air',
                        // 'panjang_drainase',
                        // 'luas_finish_struktur',
                        // 'luas_finish_plafond',
                        // 'luas_finish_dinding',
                        // 'luas_finish_kjp'
                    ]);
                }
            }
        }
    }
}
