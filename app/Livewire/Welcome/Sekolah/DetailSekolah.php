<?php

namespace App\Livewire\Welcome\Sekolah;

use App\Models\Sekolah;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;

class DetailSekolah extends ModalComponent
{
    use WithPagination;

    public Sekolah $sekolah;
    public $id;
    public $negeriIcon;
    public $swastaIcon;
    public $shadowIcon;
    public $data = [];

    protected static array $maxWidths = [

        '2xl' => 'sm:max-w-2xl',

    ];

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function mount()
    {
        $this->id = $this->sekolah->id;
        $this->negeriIcon = asset('/img/icon/school-negeri.png');
        $this->swastaIcon = asset('/img/icon/school-swasta.png');
        $this->shadowIcon = asset('/img/icon/school-shadow.png');
    }

    public function getDetailSekolah()
    {
        $sekolah =  Sekolah::with('village', 'gtk.informasi', 'gtk.user')->findOrFail($this->id);

        return $sekolah;
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
        $gtk = $data->paginate(5);

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
        return view('livewire.welcome.sekolah.detail-sekolah', [
            'detailSekolah' => $this->getSekolah(),
            'kepsek' => $this->getKepsek(),
            'gtks' => $this->getGtkSekolah(),
            'chartGtk' => $this->chartKepegawaian(),
        ]);
    }
}
