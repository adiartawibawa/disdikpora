<?php

namespace App\Livewire\Pages\Sekolahs;

use App\Models\Sekolah;
use Livewire\Component;

class ProfileSekolah extends Component
{
    public $id;

    public function mount($sekolah)
    {
        $this->id = $sekolah;
    }

    public function getDataSekolah()
    {
        $sekolah = Sekolah::with('village', 'gtk')->findOrFail($this->id);

        return $sekolah;
    }

    public function render()
    {
        return view('livewire.pages.sekolahs.profile-sekolah', [
            'sekolah' => $this->getDataSekolah()
        ])->layout('layouts.app');
    }
}
