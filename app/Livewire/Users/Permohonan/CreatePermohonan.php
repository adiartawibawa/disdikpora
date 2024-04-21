<?php

namespace App\Livewire\Users\Permohonan;

use App\Models\Layanan;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreatePermohonan extends Component implements HasForms
{
    use InteractsWithForms;

    public $layanan;
    public ?array $data = [];

    public function mount($slug)
    {
        $this->layanan = Layanan::whereSlug($slug)->firstOrFail();
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        $prasyarat = $this->layanan->prasyarat;
        $formFields = [];

        foreach ($prasyarat as $field) {
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

        return $form
            ->schema($formFields)
            ->statePath('data');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.users.permohonan.create', [
            'data' => $this->layanan
        ]);
    }
}
