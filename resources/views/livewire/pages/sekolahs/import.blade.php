<div class="w-full">
    <form wire:submit.prevent="import" enctype="multipart/form-data">
        @csrf
        <div class="w-full flex flex-row items-center justify-between">
            <input type="file" wire:model="importFile" class="@error('import_file') is-invalid @enderror">
            <button class="btn btn-primary btn-sm">Import</button>
            @error('import_file')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </form>

    @if ($importing && !$importFinished)
        <div wire:poll="updateImportProgress">Importing...please wait.</div>
    @endif

    @if ($importFinished)
        Finished importing.
    @endif
</div>
