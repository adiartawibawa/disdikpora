<?php

namespace App\Livewire\Pages\Layanan;

use App\Models\Layanan;
use Livewire\Component;

class KetentuanLayanan extends Component
{
    public Layanan $layanan;

    public function render()
    {
        return view('livewire.pages.layanan.ketentuan-layanan')->layout('layouts.app');
    }
}
