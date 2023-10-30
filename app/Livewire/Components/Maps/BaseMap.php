<?php

namespace App\Livewire\Components\Maps;

use Livewire\Component;

class BaseMap extends Component
{
    public $lat = '-8.6042279';
    public $lon = '115.1761774';

    public function render()
    {
        return view('livewire.components.maps.base-map');
    }
}
