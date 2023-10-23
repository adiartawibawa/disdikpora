<?php

namespace App\Livewire\Pages\Users;

use App\Livewire\Forms\Users\UserForm;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public UserForm $form;

    public function save()
    {
        $this->validate();

        $this->form->store();

        $this->dispatch('notify', [
            'status' => 'success',
            'message' => 'New user added successfully!'
        ]);

        return $this->redirect('/users');
    }

    public function render()
    {
        return view('livewire.pages.users.create', [
            'roles' => $this->form->allRoles(),
        ])->layout('layouts.app');
    }
}
