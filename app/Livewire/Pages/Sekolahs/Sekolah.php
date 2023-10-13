<?php

namespace App\Livewire\Pages\Sekolahs;

use App\Models\Sekolah as ModelsSekolah;
use Livewire\Component;
use Livewire\WithPagination;

class Sekolah extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search = "";
    public $checked = [];
    public $selectPage = false;
    public $selectAll = false;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';

    public function render()
    {
        return view('livewire.pages.sekolahs.sekolah', [
            'sekolahs' => $this->sekolahs
        ])->layout('layouts.app');
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->sekolahs->pluck('id')->map(fn ($item) => (string) $item)->toArray();
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
        $this->checked = $this->sekolahsQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function unselectAll()
    {
        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function getSekolahsProperty()
    {
        return $this->sekolahsQuery->paginate($this->paginate);
    }

    public function getSekolahsQueryProperty()
    {
        return ModelsSekolah::with(['village'])
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->search(trim($this->search));
    }

    public function deleteRecords()
    {
        ModelsSekolah::whereKey($this->checked)->delete();
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
        $sekolah = ModelsSekolah::findOrFail($id);
        $sekolah->delete();
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
}
