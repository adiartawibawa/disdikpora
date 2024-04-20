<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dasbor') }}
        </h2>
    </x-slot>

    <div class="container px-6 py-6 mx-auto lg:py-16">
        <div class="mb-6">
            <div>Permohonan Layanan Terbaru</div>
            <hr>
            <div>
                Anda belum ada mengajukan permohonan
            </div>
        </div>
        <div class="mb-6">
            <div>Layanan Kami</div>
            <hr>
            <div>
                @livewire('pages.layanans.page-layanan')
            </div>
        </div>

        <div class="mb-6">
            <div>Arsip Permohonan</div>
            <hr>
            <div>
                Arsip Belum Tersedia
            </div>
        </div>
    </div>
</x-app-layout>
