<?php

namespace App\Livewire\Pages\Kegiatan;

use App\Models\Kegiatan;
use Livewire\Attributes\Layout;
use Livewire\Component;

class KegiatanSingle extends Component
{
    public ?Kegiatan $kegiatan;

    public function mount($slug)
    {
        $this->kegiatan = Kegiatan::where('slug', $slug)->firstOrFail();
    }

    #[Layout('layouts.front')]
    public function render()
    {
        return view('livewire.pages.kegiatan.kegiatan-single');
    }
}
