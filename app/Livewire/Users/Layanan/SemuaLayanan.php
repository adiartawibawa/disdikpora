<?php

namespace App\Livewire\Users\Layanan;

use App\Models\Layanan;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SemuaLayanan extends Component
{
    public $layanan;
    public $panduanLayanan;

    public function mount()
    {
        $this->layanan = Layanan::orderByDesc('created_at')->get();
    }

    public function openModal($slug)
    {
        $this->panduanLayanan = Layanan::whereSlug($slug)->firstOrFail();

        $this->dispatch('open-modal', id: 'modals');
    }

    public function closeModal()
    {
        $this->dispatch('close-modal', id: 'modals');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.users.layanan.semua-layanan', [
            'layanan' => $this->layanan,
        ]);
    }
}
