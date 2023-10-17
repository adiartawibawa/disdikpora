<?php

namespace App\Imports;

use App\Models\Gtk;
use App\Models\GtkInfo;
use App\Models\Role;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class GtkImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function headingRow(): int
    {
        return 3;
    }

    public function chunkSize(): int
    {
        return 5000;
    }

    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        $user = $this->createNewUser($row);

        $gtk = new Gtk([
            'user_id' => $user->id,
            'nama' => $row['nama'],
            'nik' => $row['nik'],
            'nuptk' => $row['nuptk'],
            'nip' => $row['nip'],
            'sex' => $row['lp'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $row['tanggal_lahir'],
            'status_tugas' => Str::lower($row['status_tugas']),
            'sekolah_id' => $this->getTempatTugas($row['npsn']),
            'status_kepegawaian' => $row['status_kepegawaian'],
            'is_kepsek' => $row['jabatan_kepsek'] == 'Ya' ? True : False,
            'no_telp' => $row['nomor_hp'],
        ]);

        $gtk->save();

        $this->createInfoKepegawaianGtk($gtk, $row);

        $this->createInfoGtk($gtk, $row);

        return $gtk;
    }

    private function createInfoKepegawaianGtk($gtk, $row)
    {
        GtkInfo::create([
            'gtk_id' => $gtk->id,
            'jenis' => 'kepegawaian',
            'informasi' => json_encode([
                'pangkat_terakhir' => $row['pangkatgol'],
                'sk_cpns' => $row['sk_cpns'],
                'tanggal_cpns' => $row['tanggal_cpns'],
                'sk_pengangkatan' => $row['sk_pengangkatan'],
                'tmt_pengangkatan' => $row['tmt_pengangkatan'],
                'tmt_sk_terakhir' => $row['tmt_pangkat'],
                'sk_pangkat_terakhir' => $row['sk_pangkat_terakhir'],
                'masa_kerja_tahun' => $row['masa_kerja_tahun'],
                'masa_kerja_bulan' => $row['masa_kerja_bulan'],
            ]),
            'created_at' => $row['per_tanggal'] ?? $row['per_tanggal'] ?? now(),
        ]);
    }

    private function createInfoGtk($gtk, $row)
    {
        GtkInfo::create([
            'gtk_id' => $gtk->id,
            'jenis' => 'data ptk',
            'informasi' => json_encode([
                'jenis_ptk' => $row['jenis_ptk'],
                'pendidikan' => $row['pendidikan'],
                'bidang_studi_pendidikan' => $row['bidang_studi_pendidikan'],
                'bidang_studi_sertifikasi' => $row['bidang_studi_sertifikasi'],
                'jenis_ptk' => $row['jenis_ptk'],
                'jenis_ptk' => $row['jenis_ptk'],
                'mapel_diajarkan' => $row['mata_pelajaran_diajarkan'],
                'jam_mengajar' => $row['jam_mengajar_perminggu'],
            ]),
            'created_at' => $row['per_tanggal'] ?? $row['per_tanggal'] ?? now(),
        ]);
    }

    private function createNewUser($data)
    {
        $user = User::whereUsername($data['nik'])->first();
        $role = Role::whereName(Role::USER)->first();

        if ($user) {
            return $user;
        } else {
            $user = User::create([
                'name' => $data['nama'],
                'email' => $this->generateEmail($data['nama']),
                'username' => $data['nik'],
                'current_role_id' => $role->id,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);

            $user->assignRole($role);

            return $user;
        }
    }

    private function getTempatTugas($npsn)
    {
        $sekolah = Sekolah::whereNpsn($npsn)->first();

        return $sekolah->id;
    }

    private function generateEmail($name)
    {
        // Memecah string menjadi kata-kata berdasarkan spasi
        $words = explode(' ', $name);

        // Menggabungkan huruf pertama dari setiap kata
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtolower(substr($word, 0, 1));
        }

        // Mengubah nama menjadi huruf kecil dan menghapus spasi
        $username = strtolower(substr(str_replace(' ', '', $name), 0, 6));

        // Membuat karakter acak (misalnya, angka acak)
        $randomPart = rand(100, 999);

        // Menggabungkan nama pengguna dan karakter acak
        $email = $username . $initials . $randomPart . '@mail.test';

        return $email;
    }
}
