@section('title', 'Ketentuan Layanan')

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-base-content dark:text-gray-200 leading-tight">
        {{ __('Ketentuan Layanan') }}
    </h2>
</x-slot>

<x-slot name="breadcrumbs">
    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('layanan') }}">Layanan</a></li>
    <li class="text-primary">{{ $layanan->name }}</li>
</x-slot>

<div>
    <div class="card bg-base-100 shadow-xl w-full mb-4">
        <div class="card-body">
            <div class="card-title">
                <h2>{{ $layanan->name }}</h2>
            </div>
            <div class="text-sm">
                Estiamsi waktu layanan : <span class="text-primary">{{ $layanan->estimasi }} hari kerja layanan</span>
            </div>
            <div class="text-sm">
                <p>
                    {{ $layanan->desc }}
                </p>
            </div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row w-full gap-4">
        <div class="card bg-base-100 shadow-xl w-full md:w-1/2">
            <div class="card-body">
                <div class="card-title flex items-center justify-between">
                    <h2>Formulir Layanan</h2>
                    <button
                        wire:click="$dispatch('openModal', { component: 'pages.layanan.form-ketentuan', arguments: { layanan: '{{ $layanan->id }}', category:'formulir' }})"
                        class="btn btn-sm btn-primary">
                        <x-icon-o-plus-circle class="w-4 h-4" />
                        Tambah
                    </button>
                </div>
                <div>
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>Pemohon akan mengisi formulir :</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($layanan->ketentuans as $ketentuan)
                                    @if ($ketentuan->category == 'formulir')
                                        <tr>
                                            <td class="flex items-center justify-between">
                                                <div class="w-[80%]">
                                                    <p>
                                                        {{ $ketentuan->name }}
                                                        @if ($ketentuan->is_required)
                                                            <span class="text-red-500">*</span>
                                                        @endif
                                                    </p>
                                                    <p class="text-xs">
                                                        {{ $ketentuan->desc }}
                                                    </p>
                                                </div>
                                                <div class="inline-flex items-end justify-end  w-[20%]">
                                                    <button
                                                        wire:click="$dispatch('openModal', { component: 'pages.layanan.form-ketentuan', arguments: {layanan: '{{ $layanan->id }}', ketentuan: {{ $ketentuan->id }}, category:'formulir', is_update:true }})"
                                                        type="button" class="btn btn-xs btn-ghost">
                                                        <x-icon-o-pencil class="w-4 h-4" />
                                                    </button>
                                                    <button wire:click="deleteKetentuan({{ $ketentuan->id }})"
                                                        type="button" class="btn btn-xs btn-ghost hover:bg-red-500">
                                                        <x-icon-o-trash class="w-4 h-4 text-red-500 hover:text-white" />
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td>
                                            <p class="text-sm text-gray-500">Anda belum menginputkan
                                                formulir yang dibutuhkan</p>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-base-100 shadow-xl w-full md:w-1/2">
            <div class="card-body">
                <div class="card-title flex items-center justify-between">
                    <h2>Prasyarat Layanan</h2>
                    <button
                        wire:click="$dispatch('openModal', { component: 'pages.layanan.form-ketentuan', arguments: { layanan: '{{ $layanan->id }}', category:'prasyarat' }})"
                        class="btn btn-sm btn-primary">
                        <x-icon-o-plus-circle class="w-4 h-4" />
                        Tambah
                    </button>
                </div>
                <div>
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>Pemohon harus mempersiapkan scan dokumen asli (bukan foto
                                        copy) :</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($layanan->ketentuans as $ketentuan)
                                    @if ($ketentuan->category == 'prasyarat')
                                        <tr>
                                            <td class="flex items-center justify-between">
                                                <div class="w-[80%]">
                                                    <p>
                                                        {{ $ketentuan->name }}
                                                        @if ($ketentuan->is_required)
                                                            <span class="text-red-500">*</span>
                                                        @endif
                                                    </p>
                                                    <p class="text-xs">
                                                        {{ $ketentuan->desc }}
                                                    </p>
                                                </div>
                                                <div class="inline-flex items-end justify-end  w-[20%]">
                                                    <button
                                                        wire:click="$dispatch('openModal', { component: 'pages.layanan.form-ketentuan', arguments: {layanan: '{{ $layanan->id }}', ketentuan: {{ $ketentuan->id }}, category:'prasyarat', is_update:true }})"
                                                        type="button" class="btn btn-xs btn-ghost">
                                                        <x-icon-o-pencil class="w-4 h-4" />
                                                    </button>
                                                    <button wire:click="deleteKetentuan({{ $ketentuan->id }})"
                                                        type="button" class="btn btn-xs btn-ghost hover:bg-red-500">
                                                        <x-icon-o-trash class="w-4 h-4 text-red-500 hover:text-white" />
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td>
                                            <p class="text-sm text-gray-500">
                                                Anda belum menginputkan
                                                prasyarat yang dibutuhkan
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
