<?php

namespace App\Livewire\Pages\Sekolahs;

use App\Models\Sekolah;
use LivewireUI\Modal\ModalComponent;

class Location extends ModalComponent
{
    public Sekolah $sekolah;
    public $zoom = 13;

    protected static array $maxWidths = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
        '4xl' => 'sm:max-w-4xl',
        '5xl' => 'sm:max-w-5xl',
        '6xl' => 'sm:max-w-6xl',
        '7xl' => 'sm:max-w-7xl',
    ];

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function render()
    {
        return view('livewire.pages.sekolahs.location');
    }
}
