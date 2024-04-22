<?php

namespace App\Livewire\Pages\Layanans;

use App\Models\Layanan;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SingleLayanan extends Component implements HasForms
{
    use InteractsWithForms;

    public $layanan;
    public ?array $data = [];

    public function mount($slug)
    {
        $this->layanan = Layanan::whereSlug($slug)->firstOrFail();
        $this->form->fill();
    }

    public function openModal($slug)
    {
        // $data = Layanan::whereSlug($slug)->firstOrFail();

        $this->dispatch('open-modal', id: 'modals');
    }

    public function form(Form $form): Form
    {
        $prasyarat = $this->layanan->prasyarat;
        $formFields = [];

        if (!empty($prasyarat)) {
            foreach ($prasyarat as $field) {
                // dd($field);
                if ($field['type'] === 'string') {
                    $formFields[] = TextInput::make($field['nama'])
                        ->label($field['desc'])
                        ->required($field['required']);
                } elseif ($field['type'] === 'text') {
                    $formFields[] = Textarea::make($field['nama'])
                        ->label($field['desc'])
                        ->required($field['required']);
                }
            }
        }

        return $form
            ->schema($formFields)
            ->statePath('data');
    }

    public function closeModal()
    {
        $this->dispatch('close-modal', id: 'modals');
    }

    #[Layout('layouts.front')]
    public function render()
    {
        return view('livewire.pages.layanans.single-layanan');
    }
}
