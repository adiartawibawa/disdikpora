<?php

namespace App\Livewire\Pages\Users;

use App\Livewire\Forms\Users\UserForm;
use App\Models\User;
use Livewire\Component;

class FormUser extends Component
{
    public UserForm $form;

    public function mount(User $user): void
    {
        $this->form->setUser($user);
    }

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
        return view('livewire.pages.users.form-user', [
            'roles' => $this->form->allRoles(),
        ])->layout('layouts.app');
    }
}
