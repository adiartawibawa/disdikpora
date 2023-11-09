<div>
    <div class="card bg-base-100 max-w-2xl shadow-xl">
        <div class="card-body">
            @if ($is_update)
                <form wire:submit="update">
                @else
                    <form wire:submit="save">
            @endif
            <div class="card-title mb-4 flex flex-col items-start">
                <h2>{{ Str::ucfirst($category) }} Layanan</h2>
                <p class="mt-1 font-normal text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Silahkan tambahkan ' . $category . ' untuk kebutuhan layanan yang harus disiapkan') }}
                </p>
            </div>

            <div class="mb-8 w-full">

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nama {{ Str::ucfirst($category) }}</span>
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
                        <span class="label-text">Deskripsi {{ Str::ucfirst($category) }}</span>
                    </label>
                    <input wire:model.blur="form.desc" type="text" placeholder="" class="input input-bordered" />
                    @error('form.desc')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Tipe {{ Str::ucfirst($category) }}</span>
                    </label>
                    <select wire:model.blur="form.type" class="select select-bordered w-full">
                        <option selected>Tipe {{ Str::ucfirst($category) }}</option>
                        <option value="string">Jawaban singkat</option>
                        <option value="text">Paragraf</option>
                        <option value="image">Image/Foto</option>
                        <option value="document">Dokumen/pdf</option>
                        <option value="date">Tanggal</option>
                    </select>
                    @error('form.category')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>
                <div class="form-control mt-4">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input wire:model.blur="form.is_required" type="checkbox" value="" class="sr-only peer"
                            @checked($form->is_required)>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">wajib?</span>
                    </label>
                </div>
            </div>
            <div class="card-actions flex justify-end">
                <button type="button" wire:click="$dispatch('closeModal')" class="btn btn-ghost btn-sm">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm">{{ $is_update ? 'Sunting' : 'Simpan' }}</button>
            </div>
            </form>
        </div>
    </div>
</div>
