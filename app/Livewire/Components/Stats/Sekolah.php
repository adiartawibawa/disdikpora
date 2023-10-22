<?php

namespace App\Livewire\Components\Stats;

use App\Models\Sekolah as ModelsSekolah;
use Livewire\Component;

class Sekolah extends Component
{

    public $status = ['negeri', 'swasta'];

    private function allSekolah()
    {
        return ModelsSekolah::whereIn('status', $this->status)->get();
    }

    private function countByStatus()
    {
        $queryStatus = $this->allSekolah();

        $statusCount = $queryStatus->groupBy('status')->map(function ($status) {
            return $status->count();
        });
        // dd($statusCount);
        return $statusCount;
    }

    public function render()
    {


        return view('livewire.components.stats.sekolah', [
            'sekolah' => $this->allSekolah(),
            'countStatus' => $this->countByStatus()
        ]);
    }
}
