<?php

namespace Database\Seeders;

use App\Models\SekolahBentuk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bentukan = SekolahBentuk::defaultSekolahBentuk();

        foreach ($bentukan as $item) {
            SekolahBentuk::firstOrCreate($item);
        }

        $this->command->info('Default jenis bentukan sekolah ditambahkan.');
    }
}
