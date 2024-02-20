<?php

namespace App\Livewire\Pages\Layanans;

use App\Models\Layanan;
use Livewire\Component;

class ShowLayanan extends Component
{

    public function layanan()
    {
        return Layanan::all();
    }

    public function render()
    {
        return view(
            'livewire.pages.layanans.show-layanan',
            [
                'layanan' => $this->layanan()
            ]
        );
    }
}
