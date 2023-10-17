<?php

namespace App\Livewire\Pages\Gtks;

use Livewire\Component;

class Gtk extends Component
{
    public function render()
    {
        return view('livewire.pages.gtks.gtk')->layout('layouts.app');
    }
}
