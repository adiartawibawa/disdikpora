<?php

namespace App\Livewire\Pages\Layanan;

use App\Livewire\Forms\Layanan\KetentuanForm;
use App\Models\Layanan;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class FormKetentuan extends ModalComponent
{
    public Layanan $layanan;
    public $type;
    public KetentuanForm $form;
    public $is_update = false;

    public function mount($type)
    {
        $this->type = $type;
    }

    public function save()
    {
        $form = $this->form;
        $form->type = $this->type;
        $form->store();
    }

    public function render()
    {
        return view('livewire.pages.layanan.form-ketentuan');
    }
}
