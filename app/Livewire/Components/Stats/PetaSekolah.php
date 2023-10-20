<?php

namespace App\Livewire\Components\Stats;

use App\Models\Sekolah;
use Livewire\Component;

class PetaSekolah extends Component
{

    public function querySekolah()
    {
        return Sekolah::with('village.district')->get();
    }

    public function collectByDistricts()
    {
        $data = $this->querySekolah();

        $collectData = $data->groupBy(function ($item) {
            return $item['village'][0]['district']['name'];
        });

        return $collectData;
    }

    public function countByDistricts()
    {
        $data = $this->collectByDistricts();

        $counter = [];
        foreach ($data as $distrik => $sekolah) {
            $counter[$distrik] = $sekolah->count();
        }

        return $counter;
    }

    public function render()
    {

        return view('livewire.components.stats.peta-sekolah')->with([
            'sekolahByDistrict' => $this->countByDistricts()
        ]);
    }
}
