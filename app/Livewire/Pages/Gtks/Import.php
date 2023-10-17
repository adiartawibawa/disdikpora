<?php

namespace App\Livewire\Pages\Gtks;

use App\Jobs\ProcessingImportGtk;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class Import extends ModalComponent
{
    use WithFileUploads;

    public $batchId;
    public $importFile;
    public $importing = false;
    public $importFilePath;
    public $importFinished = false;

    protected static array $maxWidths = [
        '2xl' => 'sm:max-w-2xl',
    ];

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function import()
    {
        $this->validate([
            'importFile' => 'required',
        ]);

        $this->importing = true;
        $this->importFilePath = $this->importFile->store('imports');

        $batch = Bus::batch([
            new ProcessingImportGtk($this->importFilePath),
        ])->dispatch();

        $this->batchId = $batch->id;
    }

    public function getImportBatchProperty()
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function updateImportProgress()
    {
        $this->importFinished = $this->importBatch->finished();

        if ($this->importFinished) {
            Storage::delete($this->importFilePath);
            $this->importing = false;
        }
    }

    public function render()
    {
        return view('livewire.pages.gtks.import');
    }
}
