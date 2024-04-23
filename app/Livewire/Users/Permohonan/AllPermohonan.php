<?php

namespace App\Livewire\Users\Permohonan;

use App\Models\Permohonan;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AllPermohonan extends Component
{
    public $permohonan;

    public function mount()
    {
        $this->permohonan = Permohonan::orderByDesc('created_at')->get();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.users.permohonan.all-permohonan', [
            'permohonans' => $this->permohonan,
        ]);
    }
}
