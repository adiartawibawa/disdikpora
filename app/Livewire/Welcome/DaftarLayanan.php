<?php

namespace App\Livewire\Welcome;

use App\Models\Layanan;
use Livewire\Component;

class DaftarLayanan extends Component
{
    public function getAllLayanan()
    {
        return Layanan::all();
    }

    public function render()
    {
        return view('livewire.welcome.daftar-layanan', [
            'layanans' => $this->getAllLayanan(),
        ]);
    }
}
