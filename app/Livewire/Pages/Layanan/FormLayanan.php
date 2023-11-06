<?php

namespace App\Livewire\Pages\Layanan;

use App\Livewire\Forms\Layanan\LayananForm;
use App\Models\Layanan;
use Livewire\Component;
use Livewire\Attributes\On;

class FormLayanan extends Component
{
    public LayananForm $form;

    // public function mount(Layanan $layanan)
    // {
    //     $this->form->setLayanan($layanan);
    // }

    public function updateLayanan($layanan)
    {
        $this->form->setLayanan($layanan);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirect('/layanan');
    }

    public function update()
    {
        $this->form->update();

        return $this->redirect('/layanan');
    }

    public function render()
    {
        return view('livewire.pages.layanan.form-layanan');
    }
}
