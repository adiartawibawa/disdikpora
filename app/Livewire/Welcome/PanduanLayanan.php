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

        '3xl' => 'sm:max-w-3xl',

    ];

    public static function modalMaxWidth(): string
    {
        return '3xl';
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
