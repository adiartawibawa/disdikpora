<?php

namespace App\Livewire\Forms\Layanan;

use App\Models\Layanan;
use Livewire\Attributes\Rule;
use Livewire\Form;

class LayananForm extends Form
{

    public ?Layanan $layanan;

    #[Rule('required|min:5')]
    public $name = '';

    #[Rule('required')]
    public $estimasi = '';

    #[Rule('required|min:25')]
    public $desc = '';

    public $is_active = '';

    public function setLayanan(Layanan $layanan)
    {
        $this->layanan = $layanan;

        $this->name = $layanan->name;
        $this->estimasi = $layanan->estimasi;
        $this->desc = $layanan->desc;
        $this->is_active = $layanan->is_active;
    }

    public function store()
    {
        Layanan::create($this->only(['name', 'estimasi', 'desc']));

        $this->reset();
    }

    public function update()
    {
        $this->layanan->update(
            $this->all()
        );
    }
}
