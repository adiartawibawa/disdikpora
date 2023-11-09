<?php

namespace App\Livewire\Pages\Layanan;

use App\Models\Ketentuan;
use App\Models\Layanan;
use Livewire\Component;

class KetentuanLayanan extends Component
{
    public Layanan $layanan;

    public function deleteKetentuan($id)
    {
        $ketentuan = Ketentuan::findOrFail($id);

        $ketentuan->delete();

        $this->dispatch('notify', [
            'status' => 'success',
            'message' => ucwords($ketentuan->name . ' berhasil dihapus!')
        ]);

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.pages.layanan.ketentuan-layanan')->layout('layouts.app');
    }
}
