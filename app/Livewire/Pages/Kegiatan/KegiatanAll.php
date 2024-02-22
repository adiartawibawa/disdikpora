<?php

namespace App\Livewire\Pages\Kegiatan;

use App\Models\Kegiatan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

class KegiatanAll extends Component
{
    public $kegiatans;
    #[Url]
    public $category = null;
    #[Url]
    public $type = null;

    public function mount()
    {
        $category = $this->category;
        $type = $this->type;

        $query = Kegiatan::query()->latest();

        if ($category && $type) {
            if ($type === 'tags') {
                $query->withAnyTagsOfAnyType([$category])->get();
            } elseif ($type === 'topic') {
                $query->whereHas('topic', function ($query) use ($category) {
                    $query->where('name', $category);
                });
            }
        }

        $this->kegiatans = $query->get();
    }

    #[Layout('layouts.front')]
    public function render()
    {
        return view('livewire.pages.kegiatan.kegiatan-all', [
            'kegiatans' => $this->kegiatans,
            'type' => $this->type,
        ]);
    }
}
