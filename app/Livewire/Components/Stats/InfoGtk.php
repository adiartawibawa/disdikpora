<?php

namespace App\Livewire\Components\Stats;

use App\Models\Gtk;
use Livewire\Component;

class InfoGtk extends Component
{
    public $type;
    public string $bgIllustration = '';
    public string $title = '';

    public function mount($type, $illustration, $title)
    {
        $this->type = $type;
        $this->bgIllustration = $illustration;
        $this->title = $title;
    }

    private function detailInfoGtk($params)
    {
        $operator = strtolower($params) != 'guru' ? 'NOT LIKE' : 'LIKE';

        $detail_gtk = Gtk::whereHas('informasi', function ($query) use ($operator) {
            $query->where('jenis', 'data ptk')->where('informasi->jenis_ptk', $operator, '%Guru%');
        });

        return $detail_gtk;
    }

    private function kepsekGtk()
    {
        $kepsek = Gtk::where('is_kepsek', true);

        return $kepsek;
    }

    public function render()
    {
        switch ($this->type) {
            case 'kepsek':
                $data = $this->kepsekGtk();
                break;
            case 'tendik':
                $data = $this->detailInfoGtk($this->type);
                break;

            default:
                $data = $this->detailInfoGtk($this->type);
                break;
        }

        return view('livewire.components.stats.info-gtk')
            ->with([
                'data' => $data,
                'title' => $this->title
            ]);
    }
}
