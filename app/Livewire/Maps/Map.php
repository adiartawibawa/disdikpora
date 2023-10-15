<?php

namespace App\Livewire\Maps;

use Livewire\Component;

class Map extends Component
{
    public $latitude;
    public $longitude;
    public $zoom;

    public function mount($latitude, $longitude, $zoom)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->zoom = $zoom;
    }

    public function render()
    {
        return view('livewire.maps.map');
    }
}
