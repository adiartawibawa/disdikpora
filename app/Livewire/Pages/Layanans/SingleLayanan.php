<?php

namespace App\Livewire\Pages\Layanans;

use App\Models\Layanan;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SingleLayanan extends Component
{

    public $layanan;

    public function mount($slug)
    {
        $this->layanan = Layanan::whereSlug($slug)->firstOrFail();
    }

    #[Layout('layouts.front')]
    public function render()
    {
        return view('livewire.pages.layanans.single-layanan');
    }
}
