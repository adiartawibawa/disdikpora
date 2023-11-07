@section('title', 'Panduan Layanan')

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-base-content dark:text-gray-200 leading-tight">
        {{ __('Panduan Layanan') }}
    </h2>
</x-slot>

<x-slot name="breadcrumbs">
    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="text-primary">Panduan Layanan</li>
</x-slot>

<div>
    <div class="flex flex-col md:flex-row gap-6 items-start justify-start">
        <div class="card bg-base-100 shadow-xl md:w-3/6 w-full">
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="card-title mb-8">
                        <h2 class="text-slate-500">Form Panduan Aplikasi</h2>
                    </div>
                    <div class="space-y-4 mb-8">
                        <div class="w-full">
                            <select wire:model.live="selectedCategory" class="select select-bordered w-full">
                                <option value="" selected>Pilih Panduan Layanan</option>
                                @foreach ($layanan as $item)
                                    <option value="{{ $item['name'] }}" wire:key="{{ $item['label'] }}">
                                        {{ $item['label'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="panduanId" wire:model.live="panduanId">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Image Illustration</span>
                            </label>
                            <input type="file" wire:model.debounce.500ms="image" accept="image/*"
                                class="file-input w-full" />
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Langkah</span>
                            </label>
                            <input wire:model.live="step" type="number" placeholder="0"
                                class="input input-bordered w-full" />
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Judul Panduan</span>
                            </label>
                            <input wire:model.live="title" type="text" placeholder="Judul Panduan"
                                class="input input-bordered w-full" />
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Deskripsi Panduan</span>
                            </label>
                            <textarea wire:model.live="content" class="textarea textarea-bordered" placeholder="Deskripsi Panduan"></textarea>
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">File Attachment</span>
                            </label>
                            <input type="file" wire:model.debounce.500ms="document" accept=".pdf"
                                class="file-input w-full" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="w-full btn btn-primary btn-md">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl md:w-3/6 w-full">
            <div class="card-body">
                <div class="card-title mb-4">
                    <h2 class="text-slate-500">Panduan {{ $headerCard }}</h2>
                </div>
                <div>
                    <ol class="relative border-l border-gray-200 dark:border-gray-700">
                        @if ($selectedCategory == null)
                            <li class="mb-10 ml-6">
                                <span
                                    class="absolute flex items-center justify-center w-6 h-6 bg-indigo-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-indigo-900">
                                </span>
                                <div class="tracking-wide text-sm text-gray-500/90">
                                    Pilih terlebih dahulu kategori panduan yang ingin ditampilkan
                                </div>
                            </li>
                        @else
                            @forelse ($panduans as $item)
                                <li class="mb-10 ml-6">
                                    <span
                                        class="absolute flex items-center justify-center w-6 h-6 bg-indigo-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-indigo-900">
                                        {{ $item->step }}
                                    </span>
                                    <img src="{{ $item->image }}"
                                        class="object-cover object-center h-36 w-full max-w-full rounded-lg shadow-md"
                                        alt="{{ $item->title }}">
                                    <h3
                                        class="flex items-center my-2 text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $item->title }}
                                    </h3>
                                    <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
                                        {{ Str::limit($item->content, 250, '...') }}
                                    </p>
                                    @if ($item->file != null)
                                        <a href="#"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-indigo-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text-indigo-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                            <x-icon name="document-arrow-down" class="w-3.5 h-3.5 mr-2.5" />
                                            Panduan {{ $item->title }}
                                        </a>
                                    @endif
                                </li>

                            @empty
                                <li class="mb-10 ml-6">
                                    <span
                                        class="absolute flex items-center justify-center w-6 h-6 bg-indigo-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-indigo-900">
                                    </span>
                                    <div class="tracking-wide text-sm text-gray-500/90">
                                        Anda belum membuat panduan mengenai {{ $headerCard }}
                                    </div>
                                </li>
                            @endforelse
                        @endif
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
