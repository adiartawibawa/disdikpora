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

    public function countSekolah()
    {
        return $this->sekolah->count();
    }

    public function getJenjang()
    {
        return $this->sekolah->select('jenjang')->count();
    }

    public function render()
    {
        return view('livewire.components.stats.sekolah', [
            'sekolah' => $this->getJenjang()
        ]);
    }
}
