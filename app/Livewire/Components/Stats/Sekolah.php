<?php

namespace App\Livewire\Components\Stats;

use App\Models\Sekolah as ModelsSekolah;
use Livewire\Component;

class Sekolah extends Component
{

    public function getSekolahProperty()
    {
        return $this->sekolahQuery;
    }

    public function getSekolahQueryProperty()
    {
        return ModelsSekolah::all();
    }

    public function countAllSekolah()
    {
        return $this->sekolah->count();
    }

    public function countEachJenjang()
    {
        $jenjang = $this->sekolah->pluck('jenjang');
        $countBy = $jenjang->countBy();
        $result = $countBy->map(function ($count, $key) {
            return [$key => $count];
        })->values();

        return $result;
    }

    public function render()
    {
        return view('livewire.components.stats.sekolah', [
            'sekolah' => $this->countAllSekolah(),
            'jenjang' => $this->countEachJenjang(),
        ]);
    }
}
