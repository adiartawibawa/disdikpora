<?php

namespace App\Livewire\Pages\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AllUser extends Component
{
    use WithPagination;
    public $paginate = 10;
    public $search = "";
    public $selectedRole = null;
    public $checked = [];
    public $selectPage = false;
    public $selectAll = false;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';

    public $selectedId;

    public function allRoles()
    {
        return Role::all();
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->users->pluck('id')->map(fn ($item) => (string) $item)->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function updatedChecked()
    {
        $this->selectPage = false;
    }

    public function selectAll()
    {
        $this->selectAll = true;
        $this->checked = $this->usersQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function unselectAll()
    {
        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function getUsersProperty()
    {
        return $this->usersQuery->paginate($this->paginate);
    }

    public function getUsersQueryProperty()
    {
        return User::with(['roles'])
            ->when($this->selectedRole, function ($query) {
                $query->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('id', $this->selectedRole);
                });
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->search(trim($this->search));
    }

    public function deleteRecords()
    {
        User::whereKey($this->checked)->delete();
        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;

        $this->dispatch('notify', [
            'status' => 'success',
            'message' => 'Selected Records were deleted Successfully'
        ]);
    }

    // public function exportSelected()
    // {
    //     return (new StudentsExport($this->checked))->download('students.xlsx');
    // }

    public function deleteSingleRecord($id)
    {
        $user = User::findOrFail($id);
        $roles = $user->getRoleNames();
        foreach ($roles as $role) {
            $user->removeRole($role);
        }
        $user->delete();
        $this->checked = array_diff($this->checked, [$id]);


        $this->dispatch('notify', [
            'status' => 'success',
            'message' => 'Record deleted Successfully'
        ]);
    }

    public function isChecked($id)
    {
        return in_array($id, $this->checked);
    }

    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function render()
    {
        return view('livewire.pages.users.all-user')->with([
            'users' => $this->users,
            'roles' => $this->allRoles()
        ])->layout('layouts.app');
    }
}
