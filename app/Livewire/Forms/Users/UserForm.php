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

    #[Rule('string|max:10|unique:' . User::class . ',username')]
    public $username = '';

    #[Rule('required|string|email|max:255|unique:' . User::class . ',email')]
    public $email = '';

    #[Rule('required|string|max:255|confirmed')]
    public $password = '';

    public string $password_confirmation = '';

    public string $roles = '';

    public function setUser(User $user)
    {
        $this->user = $user;

        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;

        $this->roles = $user->getRoleNames()->implode(', ');
    }

    public function store()
    {
        $item = User::create($this->all());

        $item->assignRole($this->only(['roles']));

        $item->update([
            'current_role_id' => $this->getRoleId($this->only(['roles']))
        ]);

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

    public function getRoleId($name)
    {
        $role = Role::whereName($name)->first();

        return $role->id;
    }
}
