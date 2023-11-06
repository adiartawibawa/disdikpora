<?php

namespace App\Livewire\Pages\Layanan;

use App\Models\Layanan;
use Livewire\Component;
use Livewire\WithPagination;

class LayananTersedia extends Component
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
            $this->checked = $this->layanans->pluck('id')->map(fn ($item) => (string) $item)->toArray();
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
        $this->checked = $this->layanansQuery->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    public function unselectAll()
    {
        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function getLayanansProperty()
    {
        return $this->layanansQuery->paginate($this->paginate);
    }

    public function getLayanansQueryProperty()
    {
        return Layanan::orderBy($this->sortColumnName, $this->sortDirection)
            ->search(trim($this->search));
    }

    public function deleteRecords()
    {
        Layanan::whereKey($this->checked)->delete();
        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;
        session()->flash('info', 'Selected Records were deleted Successfully');
    }

    public function deleteSingleRecord($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();
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
        return view('livewire.pages.layanan.layanan-tersedia', [
            'layanans' => $this->layanans
        ])->layout('layouts.app');
    }
}
