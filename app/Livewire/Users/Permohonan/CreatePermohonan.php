<?php

namespace App\Livewire\Users\Permohonan;

use App\Models\Layanan;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreatePermohonan extends Component
{

    public $layanan;

    public function mount($slug)
    {
        $this->layanan = Layanan::whereSlug($slug)->firstOrFail();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.users.permohonan.create', [
            'layanan' => $this->layanan
        ]);
    }
}
