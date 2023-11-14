<div class="card shadow-xl bg-base-100">
    <div class="card-body">
        <div class="card-title">
            <h1>{{ $sekolah->nama }}</h1>
        </div>
        <div>

        </div>
        <div class="card-actions">
            <button wire:click="$dispatch('closeModal')" class="btn btn-sm btn-primary">Close</button>
        </div>
    </div>
</div>
