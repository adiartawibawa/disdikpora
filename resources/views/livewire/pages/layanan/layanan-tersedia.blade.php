@section('title', 'Layanan')

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-base-content dark:text-gray-200 leading-tight">
        {{ __('Layanan Tersedia') }}
    </h2>
</x-slot>

<x-slot name="breadcrumbs">
    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="text-primary">Layanan</li>
</x-slot>

<div>
    <div class="flex flex-col md:flex-row gap-6 items-start justify-start">

        <livewire:pages.layanan.form-layanan />

        <div class="card bg-base-100 shadow-xl md:w-4/6 w-full">
            <div class="card-body">
                <div class="card-title">
                    <h2 class="">Data Layanan</h2>
                </div>
                <div class="pb-4 flex flex-col md:flex-row items-center md:items-end md:justify-between gap-4 md:gap-0">
                    <div class="inline-flex flex-col md:flex-row gap-2 w-full md:w-2/3">
                        <div class="form-control w-full max-w-xs">
                            <label class="label">
                                <span class="label-text">Per page</span>
                            </label>
                            <select id="paginate" wire:model.live="paginate" class="select select-bordered">
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full inline-flex justify-end">
                        <input type="text" placeholder="Search for items by" id="search"
                            wire:model.live.debounce.500ms="search" class="input input-bordered w-full md:max-w-xs" />
                    </div>
                </div>

                {{-- selected data  --}}
                <div class="flex w-full items-center justify-between">
                    <div class="text-sm text-gray-800">
                        @if ($selectPage)
                            <div class="mb-4">
                                @if ($selectAll)
                                    <div>
                                        You have selected all <strong>{{ $layanans->total() }}</strong> items.
                                        <a href="#" class="underline text-indigo-800 ml-2"
                                            wire:click.prevent="unselectsAll">Batalkan Semua</a>
                                    </div>
                                @else
                                    <div>
                                        You have selected <strong>{{ count($checked) }}</strong> items, Do you want to
                                        Select
                                        All
                                        <strong>{{ $layanans->total() }}</strong>?
                                        <a href="#" class="underline text-indigo-800 ml-2"
                                            wire:click.prevent="selectsAll">Pilih Semua</a>
                                    </div>
                                @endif

                            </div>
                        @endif
                    </div>
                    <div>
                        @if ($checked)
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                                        <div>With Checked ({{ count($checked) }})</div>

                                        <div class="ml-1">
                                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link href="#"
                                        onclick="confirm('Are you sure you want to delete these Records?') || event.stopImmediatePropagation()"
                                        wire:click="deleteRecords()">
                                        Delete
                                    </x-dropdown-link>
                                    <x-dropdown-link href="#"
                                        onclick="confirm('Are you sure you want to export these Records?') || event.stopImmediatePropagation()"
                                        wire:click="exportSelected()">
                                        Export
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        @endif
                    </div>
                </div>
                {{-- end selected data  --}}
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>
                                    <label>
                                        <input type="checkbox" class="checkbox" wire:model.live="selectPage" />
                                    </label>
                                </th>
                                <th>
                                    Layanan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($layanans as $item)
                                <tr>
                                    <th>
                                        <label>
                                            <input type="checkbox" class="checkbox" type="checkbox" value=""
                                                wire:model.live="checked" />
                                        </label>
                                    </th>
                                    <td>
                                        <div>
                                            <p class="font-semibold">{{ $item->name }}</p>
                                            <p>Estimasi Layanan : {{ $item->estimasi }}</p>
                                            <p>{{ Str::limit($item->desc, 150, '...') }}</p>
                                        </div>
                                    </td>
                                    <th>
                                        <button title="Edit Layanan" wire:click="editLayanan('{{ $item->id }}')"
                                            class="btn btn-sm btn-ghost text-xs">
                                            <x-icon-o-pencil-square class="h-4 w-4" />
                                        </button>
                                        @if ($item->is_active)
                                            <button title="Aktifkan Layanan"
                                                wire:click="toggleIsActive({{ $item }})"
                                                class="btn btn-sm btn-ghost text-xs">
                                                <x-icon-o-eye-slash class="h-4 w-4" />
                                            </button>
                                        @else
                                            <button title="Non-Aktifkan Layanan"
                                                wire:click="toggleIsActive({{ $item }})"
                                                class="btn btn-sm btn-ghost text-xs">
                                                <x-icon-o-eye class="h-4 w-4" />
                                            </button>
                                        @endif
                                        <button title="Formulir dan Prasyarat"
                                            wire:click="addKetentuanLayanan('{{ $item->id }}')" name="Detail"
                                            class="btn btn-sm btn-ghost text-xs">
                                            <x-icon-o-clipboard-document-check class="h-4 w-4" />
                                        </button>
                                        <button title="Hapus Layanan"
                                            class="btn btn-sm btn-ghost text-error text-xs hover:bg-error hover:text-white">
                                            <x-icon-o-trash class="h-4 w-4" />
                                        </button>
                                    </th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <x-empty-data />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {!! $layanans->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
