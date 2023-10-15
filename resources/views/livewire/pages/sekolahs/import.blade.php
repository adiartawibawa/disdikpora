<div class="card">
    <div class="card-body">
        <h2 class="card-title">Import data sekolah dari excel</h2>
        <p class="text-sm">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit facere unde
            cupiditate autem! Repudiandae corporis vel, ducimus nam eum quia nihil quae perferendis, provident
            id repellat laborum facere libero esse.
        </p>
        <div class="py-2 text-sm inline-flex justify-start items-start">
            <p>
                Silahkan gunakan format excel berikut
                <a href="{{ asset('format/import_data_sekolah.xlsx') }}" download class="ml-2 text-primary underline">
                    format data sekolah
                </a>
            </p>
        </div>

        <div class="py-4 w-full">
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

        <div class="card-actions justify-end">
            <button x-on:click="$dispatch('close')" class="btn btn-active">{{ __('Close') }}</button>
        </div>
    </div>
</div>
