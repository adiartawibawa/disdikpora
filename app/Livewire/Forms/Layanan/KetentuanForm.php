<?php

namespace App\Livewire\Forms\Layanan;

use App\Models\Ketentuan;
use Livewire\Attributes\Rule;
use Livewire\Form;

class KetentuanForm extends Form
{
    public ?Ketentuan $ketentuan;

    #[Rule('required|min:5')]
    public $name = '';
    #[Rule('required|min:10')]
    public $desc = '';
    public $category = '';
    #[Rule('required|min:5')]
    public $type = "";
    public $is_required = true;

    public function setKetentuan(Ketentuan $ketentuan)
    {
        $this->ketentuan = $ketentuan;

        $this->name = $ketentuan->name;
        $this->desc = $ketentuan->desc;
        $this->category = $ketentuan->category;
        $this->type = $ketentuan->type;
        $this->is_required = $ketentuan->is_required;
    }

    public function store()
    {
        dd($this->all());
        Ketentuan::create($this->all());

        $this->reset();
    }

    public function update()
    {
        $this->ketentuan->update(
            $this->all()
        );
        $this->reset();
    }
}
