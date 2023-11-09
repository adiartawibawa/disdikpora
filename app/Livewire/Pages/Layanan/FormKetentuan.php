<?php

namespace App\Livewire\Pages\Layanan;

use App\Livewire\Forms\Layanan\KetentuanForm;
use App\Models\Ketentuan;
use App\Models\Layanan;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\On;

class FormKetentuan extends ModalComponent
{
    public Layanan $layanan;
    public $category;
    public KetentuanForm $form;
    public $is_update = false;

    public function mount(Ketentuan $ketentuan)
    {
        $this->category = $this->category;
        $this->form->setKetentuan($ketentuan);
    }

    public function save()
    {
        $form = $this->form;
        $form->category = $this->category;
        $form->ketentuan_id = $this->layanan->id;
        $form->ketentuan_type = Layanan::class;

        $form->store();

        $this->dispatch('notify', [
            'status' => 'success',
            'message' => ucwords($this->category . ' Ketentuan berhasil ditambahkan!')
        ]);

        $this->closeModal();

        return redirect()->route('layanan.ketentuan', $this->layanan->id);
    }

    public function update()
    {
        $form = $this->form;
        $form->category = $this->category;
        $form->ketentuan_id = $this->layanan->id;
        $form->ketentuan_type = Layanan::class;
        $this->is_update = false;

        $form->update();

        $this->dispatch('notify', [
            'status' => 'success',
            'message' => ucwords($this->category . ' Ketentuan berhasil diperbarui!')
        ]);

        $this->closeModal();

        return redirect()->route('layanan.ketentuan', $this->layanan->id);
    }

    public function render()
    {
        return view('livewire.pages.layanan.form-ketentuan');
    }
}
