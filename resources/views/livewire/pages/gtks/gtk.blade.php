@section('title', 'Dashboard')

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-base-content dark:text-gray-200 leading-tight">
        {{ __('Data GTK') }}
    </h2>
</x-slot>

<x-slot name="breadcrumbs">
    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="text-primary">Data GTK</li>
</x-slot>

<div>
    <div class="grid md:grid-cols-3 col-span-3 gap-4 mb-8 w-full">

        {{-- Component Guru  --}}
        <livewire:components.stats.info-gtk type="guru" title="Guru" :illustration="url(
            'https://img.freepik.com/free-vector/illustration-character-civil-servants-indonesia-wearing-work-uniforms_10045-683.jpg?w=740&t=st=1697701660~exp=1697702260~hmac=ccc4db9182827fd9e5d79cb829958579ff3b0db2b72f9a77815b23b43326d15e',
        )" />
        {{-- End Component Guru  --}}

        {{-- Component Kepala Sekolah  --}}
        <livewire:components.stats.info-gtk type="kepsek" title="Kepala Sekolah" :illustration="url(
            'https://img.freepik.com/free-vector/back-back-concept-illustration_114360-5999.jpg?w=740&t=st=1697705057~exp=1697705657~hmac=cf4b72ca07d4261b6123a3f8da017e742825ca23e485532961aa811a33aa403a',
        )" />
        {{-- End Component Kepala Sekolah  --}}

        {{-- Component Tendik  --}}
        <livewire:components.stats.info-gtk type="tendik" title="Tenaga Kependidikan" :illustration="url(
            'https://img.freepik.com/free-vector/xavector-illustration-civil-servants-indonesia-with-various-stylish-poses_10045-740.jpg?w=740&t=st=1697704944~exp=1697705544~hmac=55f13175686a39e31b4251370f8a1f5f148e4a4f3042ae53a3926b446cb0b7a1',
        )" />
        {{-- End Component Tendik  --}}

    </div>
    <div class="card w-full bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="card-title inline-flex justify-between items-center">
                <h2>Data Guru & Tenaga Pendidik</h2>

                <div class="inline-flex items-center gap-1">
                    <button class="btn btn-primary btn-sm">
                        <x-icon-o-plus-circle class="w-5 h-5" />
                    </button>
                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="btn btn-ghost btn-sm">
                            <x-icon-o-ellipsis-vertical class="w-4 h-4" />
                        </label>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                <a wire:click.prevent="$dispatch('openModal', {component:'pages.gtks.import'})"
                                    href="#" class="text-sm">Import from Excel</a>
                            </li>
                            <li><a href="#" class="text-sm">Export to Excel</a></li>
                        </ul>
                    </div>

                </div>
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
                    <div class="form-control w-full max-w-xs">
                        {{-- <label class="label">
                            <span class="label-text">Filter by</span>
                        </label>
                        <select class="select select-bordered">
                            <option disabled selected>Pick one</option>
                            <option>Kecamatan</option>
                            <option>Desa</option>
                        </select> --}}
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
                                    You have selected all <strong>{{ $gtks->total() }}</strong> items.
                                    <a href="#" class="underline text-indigo-800 ml-2"
                                        wire:click.prevent="unselectsAll">Batalkan Semua</a>
                                </div>
                            @else
                                <div>
                                    You have selected <strong>{{ count($checked) }}</strong> items, Do you want to
                                    Select
                                    All
                                    <strong>{{ $gtks->total() }}</strong>?
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
                                Nama
                            </th>
                            <th>NIP</th>
                            <th>NUPTK</th>
                            <th>Status Kepegawaian</th>
                            <th>No. Telp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gtks as $item)
                            <tr>
                                <th>
                                    <label>
                                        <input type="checkbox" class="checkbox" type="checkbox"
                                            value="{{ $item->id }}" wire:model.live="checked" />
                                    </label>
                                </th>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->nuptk }}</td>
                                <td>
                                    {{ $item->status_kepegawaian }}
                                </td>
                                <td>{{ $item->no_telp }}</td>
                                <th>
                                    <button class="btn btn-sm btn-ghost text-xs">
                                        <x-icon-o-pencil-square class="h-4 w-4" />
                                    </button>
                                    <button class="btn btn-sm btn-ghost text-error text-xs">
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
            <div class="card-actions justify-end">
                {!! $gtks->onEachSide(5)->links() !!}
            </div>
        </div>
    </div>

</div>
