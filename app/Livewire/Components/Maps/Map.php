<?php

namespace App\Livewire\Components\Maps;

use Livewire\Component;

class Map extends Component
{
    public $lat = '-8.4644416';
    public $lon = '115.2808069';
    public $zoom = '10';

    public function render()
    {
        return view('livewire.components.maps.map');
    }
}
