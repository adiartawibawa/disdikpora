<?php

namespace App\Livewire\Pages\Layanan;

use App\Models\Layanan;
use App\Models\Panduan as ModelsPanduan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Panduan extends Component
{
    use WithFileUploads;

    public $layanan;
    public $categories;
    public $selectedCategory = null;
    public $headerCard;
    public $panduans = [];
    public $step = 0;
    public $title, $content;
    public $image, $document = null;
    public $panduanId;

    public function mount()
    {
        $this->layanan = $this->allLayanan();
    }

    public function allLayanan()
    {
        $layanans = Layanan::all();

        $layanan = $layanans->map(function ($layanan) {
            return [
                'name' => Str::slug($layanan->name),
                'label' => $layanan->name,
            ];
        });

        return $layanan;
    }

    public function updatedSelectedCategory()
    {
        $this->headerCard = ucwords(str_replace('-', ' ', $this->selectedCategory));

        $this->getPanduan($this->selectedCategory);

        $this->countLastStep($this->selectedCategory);
    }

    public function countLastStep($selectedCategory)
    {
        $step = ModelsPanduan::where('jenis', $selectedCategory)->latest()->first();

        $this->step = ($step != null) ? ++$step->step : 1;
    }

    public function save()
    {
        $params = $this->validate([
            'selectedCategory' => 'required',
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
            'step' => 'required',
            'document' => 'max:2048' // PDF dengan maksimum ukuran 2MB
        ]);

        if ($this->panduanId == "") {

            $panduan = ModelsPanduan::create([
                'jenis' => $this->selectedCategory,
                'title' => $params['title'],
                'content' => $params['content'],
                'step' => $params['step'],
            ]);

            if ($params['document'] != "") {
                $panduan->file = $this->uploadFile($panduan, $params['document'], 'document');
            }

            $panduan->image = $this->uploadFile($panduan, $params['image'], 'images');

            $panduan->save();

            session()->flash('message', 'Panduan berhasil ditambahkan.');

            $this->dispatch('notify', [
                'status' => 'success',
                'message' => 'Panduan ' . $this->headerCard . ' berhasil ditambahkan.'
            ]);
        } else {
            $this->update($this->panduanId, $params);
        }

        $this->resetForm();
        $this->updatedSelectedCategory();
    }

    private function uploadFile($panduan, $media, $collection)
    {
        $panduan->clearMediaCollection($collection);
        $panduan->addMedia($media)->toMediaCollection($collection);

        return $panduan->getFirstMedia($collection)->getUrl();
    }

    public function update($id, $params)
    {
        $panduan = ModelsPanduan::findOrFail($id);
        $panduan->jenis = $this->selectedCategory;
        $panduan->title = $params['title'];
        $panduan->content = $params['content'];
        $panduan->step = $params['step'];

        $panduan->save();
    }

    private function resetForm()
    {
        $this->title = '';
        $this->content = '';
        $this->image = null;
        $this->document = null;
        $this->step = ++$this->step;
    }

    public function getPanduan($jenis)
    {
        $this->panduans = ModelsPanduan::where('jenis', $jenis)->get();

        return $this->panduans;
    }

    public function render()
    {
        return view('livewire.pages.layanan.panduan')->layout('layouts.app');
    }
}
