<?php

namespace App\Livewire\Pages\Layanan;

use App\Livewire\Forms\Layanan\LayananForm;
use App\Models\Layanan;
use Livewire\Component;
use Livewire\Attributes\On;

class FormLayanan extends Component
{
    public LayananForm $form;

    public $is_update = false;

    #[On('edit-layanan')]
    public function updateLayanan(Layanan $layanan)
    {
        $this->is_update = true;
        $this->form->setLayanan($layanan);
    }

    public function save()
    {
        $this->form->store();

        $this->dispatch('notify', [
            'status' => 'success',
            'message' => ucwords('Layanan berhasil ditambahkan!')
        ]);

        return $this->redirect('/layanan');
    }

    public function update()
    {
        $this->form->update();
        $this->is_update = false;
        return $this->redirect('/layanan');
    }

    public function render()
    {
        return view('livewire.pages.layanan.form-layanan');
    }
}
