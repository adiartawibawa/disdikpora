<?php

namespace App\Livewire\Forms\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user;

    #[Rule('required|string|max:255')]
    public $name = '';

    #[Rule('required|string|max:255|unique:users,username')]
    public $username = '';

    #[Rule('required|string|email|max:255|unique:users,email')]
    public $email = '';

    #[Rule('required|string|max:255|confirmed')]
    public $password = '';

    public string $password_confirmation = '';

    public $roles;

    public function setUser(User $user)
    {
        $this->user = $user;

        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
    }

    public function store()
    {
        $item = User::create($this->all());
        $item->assignRole($this->only(['roles']));
        $this->reset();
    }

    public function update()
    {
        $this->user->update($this->all());
    }

    public function allRoles()
    {
        return Role::pluck('name');
    }
}
