<?php

namespace App\Livewire\Pages\Layanans;

use App\Models\Layanan;
use Livewire\Component;

class PageLayanan extends Component
{
    public function showLayanan()
    {
        return Layanan::all();
    }

    public function openModal()
    {
        $this->dispatch('open-modal', id: 'modals');
    }

    public function render()
    {
        return view('livewire.pages.layanans.page-layanan', [
            'layanan' => $this->showLayanan(),
        ]);
    }
}
