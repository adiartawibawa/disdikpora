<?php

namespace App\Livewire\Pages\Sekolahs;

use App\Models\Sekolah;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class ProfileSekolah extends Component
{
    use WithPagination;

    public $id;
    public $negeriIcon;
    public $swastaIcon;
    public $shadowIcon;
    public $data = [];

    public function mount($sekolah)
    {
        $this->id = $sekolah;
        $this->negeriIcon = asset('/img/icon/school-negeri.png');
        $this->swastaIcon = asset('/img/icon/school-swasta.png');
        $this->shadowIcon = asset('/img/icon/school-shadow.png');
    }

    public function getDetailSekolah()
    {
        return Sekolah::with('village', 'gtk.informasi', 'gtk.user')->findOrFail($this->id);
    }

    public function getSekolah()
    {
        $data = $this->getDetailSekolah();

        $sekolah = [
            'nama' => $data->nama,
            'npsn' => $data->npsn,
            'status' => $data->status,
            'alamat' => $data->alamat,
            'geo_lokasi' => [$data->lokasi->latitude, $data->lokasi->longitude],
            'kode_pos' => $data->village->first()->meta['pos'],
            'desa' => ucfirst(Str::lower($data->village->first()->name)),
            'kecamatan' => ucfirst(Str::lower($data->village->first()->district->name)),
        ];

        return $sekolah;
    }

    public function getGtkSekolah()
    {
        $data = $this->getDetailSekolah()->gtk();
        $gtk = $data->paginate(15);

        return $gtk;
    }

    public function groupStatusKepegawaian()
    {
        $data = $this->getDetailSekolah()->gtk->groupBy('status_kepegawaian')->map(function ($group) {
            return [
                'counts' => $group->count(),
                'items' => $group,
            ];
        });

        return $data;
    }

    public function chartKepegawaian()
    {
        $data = $this->groupStatusKepegawaian();

        // Memproses data menjadi format yang sesuai untuk grafik
        $this->data = $data->map(function ($group, $statusKepegawaian) {
            return [
                'label' => $statusKepegawaian,
                'value' => $group['counts'],
                'color' => $this->generateRandomColor(), // Membuat warna acak berdasarkan status_kepegawaian
            ];
        });

        $chartModel = LivewireCharts::pieChartModel();
        foreach ($this->data as $item) {
            $chartModel->addSlice($item['label'], $item['value'], $item['color']);
        }

        return $chartModel;
    }

    public function getKepsek()
    {
        $sekolah = $this->getDetailSekolah();

        return $sekolah->gtk->where('is_kepsek', 1)->first();
    }

    private function generateRandomColor()
    {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }

    public function render()
    {
        return view('livewire.pages.sekolahs.profile-sekolah', [
            'sekolah' => $this->getSekolah(),
            'kepsek' => $this->getKepsek(),
            'gtks' => $this->getGtkSekolah(),
            'chartGtk' => $this->chartKepegawaian(),
        ])->layout('layouts.app');
    }
}
