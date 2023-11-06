<div class="card bg-base-100 shadow-xl md:w-2/6 w-full">
    @if (isset($layanan->id))
        <form wire:submit="update">
        @else
            <form wire:submit="save">
    @endif
    <div class="card-body space-y-6">
        <div class="card-title">
            <h2 class="">{{ isset($layanan->id) ? 'Edit' : 'Tambah' }} Layanan</h2>
        </div>
        <div class="space-y-4">
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Jenis Layanan</span>
                </label>
                <input wire:model.blur="form.name" type="text" placeholder="" class="input input-bordered" />
                @error('form.name')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Estimasi Layanan (hari)</span>
                </label>
                <input wire:model.blur="form.estimasi" type="number" placeholder="0" class="input input-bordered" />
                @error('form.estimasi')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Deskripsi Layanan</span>
                </label>
                <textarea wire:model.blur="form.desc" class="textarea textarea-bordered" placeholder=""></textarea>
                @error('form.estimasi')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit"
                class="btn btn-primary w-full">{{ isset($layanan->id) ? 'Sunting' : 'Simpan' }}</button>
        </div>
    </div>
    </form>
</div>
