<?php

namespace App\Livewire\Pages\Gtks;

use App\Models\Gtk as ModelsGtk;
use Livewire\Component;
use Livewire\WithPagination;

class Gtk extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search = "";
    public $checked = [];
    public $selectPage = false;
    public $selectAll = false;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->gtks->pluck('id')->map(fn ($item) => (string) $item)->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function updatedChecked()
    {
        $this->selectPage = false;
    }

    public function selectsAll()
    {
        $this->selectAll = true;
        $this->checked = $this->gtksQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function unselectsAll()
    {
        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function getGtksProperty()
    {
        return $this->gtksQuery->paginate($this->paginate);
    }

    public function getGtksQueryProperty()
    {
        return ModelsGtk::orderBy($this->sortColumnName, $this->sortDirection)
            ->search(trim($this->search));
    }

    public function deleteRecords()
    {
        ModelsGtk::whereKey($this->checked)->delete();
        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
        session()->flash('info', 'Selected Records were deleted Successfully');
    }

    // public function exportSelected()
    // {
    //     return (new StudentsExport($this->checked))->download('students.xlsx');
    // }

    public function deleteSingleRecord($id)
    {
        $gtk = ModelsGtk::findOrFail($id);
        $gtk->delete();
        $this->checked = array_diff($this->checked, [$id]);
        session()->flash('info', 'Record deleted Successfully');
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
        return view('livewire.pages.gtks.gtk', [
            'gtks' => $this->gtks
        ])->layout('layouts.app');
    }
}
