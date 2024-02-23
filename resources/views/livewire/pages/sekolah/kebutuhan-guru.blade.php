<div>
    <div class="w-full">
        <section class="container px-6 py-8 mx-auto lg:py-16">
            <div class="mb-6 text-gray-800">
                <h1 class="font-bold md:text-3xl text-lg uppercase">Kebutuhan Guru di kabupaten Badung</h1>
                <div class="max-w-screen-md text-sm mt-2 text-gray-600">
                    Halaman ini memberikan gambaran menyeluruh tentang kebutuhan guru di Kabupaten Badung, membantu
                    dalam perencanaan kebijakan pendidikan, dan memfasilitasi proses perekrutan tenaga pendidik.
                </div>
            </div>

            {{ $this->table }}
        </section>
    </div>

    @empty(!$record)
        <x-filament::modal id="modals" width="2xl">
            <x-slot name="heading">
                <h1 class="text-lg font-bold">Kebutuhan Guru di {{ $record->organisation->name }}</h1>
            </x-slot>
            <x-slot name="description">
                <div class="text-sm">
                    Jumlah Kebutuhan : <span class="font-semibold">{{ $record->jml_kurang }} Orang</span>
                </div>
                <div class="text-sm">
                    Guru yang dibutuhkan : <span class="font-semibold">{{ $record->jenisPtk->name }}</span>
                </div>
            </x-slot>
            <div>
                @livewire('pages.sekolah.lokasi', ['sekolah' => $record->organisation->id])
            </div>
        </x-filament::modal>
    @endempty
</div>
