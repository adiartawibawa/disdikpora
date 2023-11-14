<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h2 class="text-3xl text-gray-800 font-bold">
                {{ $sekolah->nama }}
            </h2>
        </div>

        <div x-data="{
            openTab: 1,
            activeClasses: 'border-l border-t border-r rounded-t text-white bg-primary',
            inactiveClasses: 'hover:text-white hover:bg-primary hover:rounded-t'
        }" class="py-4 ">
            <ul class="flex border-b overflow-x-auto no-scrollbar">
                <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
                    <button :class="openTab === 1 ? activeClasses : inactiveClasses"
                        class="bg-white inline-block py-2 px-4 font-semibold">
                        Umum
                    </button>
                </li>
                <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
                    <button :class="openTab === 2 ? activeClasses : inactiveClasses"
                        class="bg-white inline-block py-2 px-4 font-semibold">
                        Infografis
                    </button>
                </li>
                <li @click="openTab = 3" :class="{ '-mb-px': openTab === 3 }" class="mr-1">
                    <button :class="openTab === 3 ? activeClasses : inactiveClasses"
                        class="bg-white inline-block py-2 px-4 font-semibold">
                        GTK
                    </button>
                </li>
            </ul>
            <div class="w-full mt-4 text-slate-600 h-80 overflow-y-auto">
                <div x-show="openTab === 1">
                    <div>
                        <p>Kepala Sekolah :
                            @empty($kepsek)
                                <span class="italic text-sm text-gray-300">Data belum tersedia</span>
                            @else
                                {{ $kepsek->nama }}
                            @endempty
                        </p>
                        <p>Status : {{ ucfirst($detailSekolah['status']) }}</p>
                        <p>Alamat : {{ $detailSekolah['alamat'] }}</p>
                        <p>Kode Pos : {{ $detailSekolah['kode_pos'] }}</p>
                        <p>Desa : {{ ucfirst(Str::lower($detailSekolah['desa'])) }}</p>
                        <p>Kecamatan : {{ ucfirst(Str::lower($detailSekolah['kecamatan'])) }}</p>
                    </div>
                </div>
                <div x-show="openTab === 2" class="w-full h-full pt-6">
                    @empty($gtks)
                        <div class="italic text-sm text-gray-300">Data belum tersedia</div>
                    @else
                        <livewire:livewire-pie-chart :pie-chart-model="$chartGtk" />
                    @endempty
                </div>
                <div x-show="openTab === 3">
                    <div class="mb-2 space-y-2">
                        @forelse ($gtks as $gtk)
                            <div class="flex items-center space-x-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle w-16 h-16">
                                        <img src="https://www.gravatar.com/avatar/'{{ md5($gtk->user->avatar_url) }}'?d=mp"
                                            alt="{{ $gtk->nama }}" />
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold">{{ $gtk->nama }}</div>
                                    <div class="text-base">
                                        @foreach ($gtk->informasi as $informasi)
                                            @if ($informasi['jenis'] === 'data ptk')
                                                PTK
                                                :
                                                {{ optional(json_decode($informasi['informasi'], true))['jenis_ptk'] }}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="text-base">
                                        Kepegawaian : {{ $gtk->status_kepegawaian }}
                                    </div>
                                    <div class="text-sm opacity-50">
                                        Tugas : {{ Str::ucfirst($gtk->status_tugas) }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="inline-flex w-full justify-center items-center">
                                <x-empty-data />
                            </div>
                        @endforelse
                    </div>
                    {!! $gtks->onEachSide(5)->links() !!}
                </div>
            </div>
        </div>

        <div class="card-actions inline-flex justify-end">
            <button wire:click="$dispatch('closeModal')" class="btn btn-primary">Tutup</button>
        </div>
    </div>
</div>
