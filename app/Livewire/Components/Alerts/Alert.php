<?php

namespace App\Livewire\Components\Alerts;

use Illuminate\Support\Arr;
use Livewire\Component;

class Alert extends Component
{
    /** @var string */
    public $type;

    public function __construct(string $type = 'alert')
    {
        $this->type = $type;
    }

    public function message(): string
    {
        return (string) Arr::first($this->messages());
    }

    public function messages(): array
    {
        return (array) session()->get($this->type);
    }

    public function exists(): bool
    {
        return session()->has($this->type) && !empty($this->messages());
    }

    public function render()
    {
        return view('livewire.components.alerts.alert');
    }
}
