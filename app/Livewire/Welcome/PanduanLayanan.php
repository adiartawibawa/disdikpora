<?php

namespace App\Livewire\Welcome;

use App\Models\Layanan;
use App\Models\Panduan;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;

class PanduanLayanan extends ModalComponent
{
    public Layanan $layanan;

    public $panduan;

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

    public function mount()
    {
        $this->panduan = Panduan::whereJenis(Str::slug($this->layanan->name))->get();
    }

    public function render()
    {
        return view('livewire.welcome.panduan-layanan');
    }
}
