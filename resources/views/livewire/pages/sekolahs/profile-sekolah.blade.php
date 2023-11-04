@section('title', $sekolah['nama'])

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-base-content dark:text-gray-200 leading-tight">
        {{ __('Sekolah') }}
    </h2>
</x-slot>

<x-slot name="breadcrumbs">
    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('sekolah.all') }}">Sekolah</a></li>
    <li class="text-primary">{{ $sekolah['nama'] }}</li>
</x-slot>

<div>
    <section class="flex md:flex-row flex-col w-full mb-6 gap-6">
        <div class="w-full md:w-2/3">
            <div class="card bg-base-100 shadow-xl w-full">
                <div class="card-body">
                    <div class="card-title">Lokasi Sekolah</div>
                    <div wire:ignore id="map" class="w-full h-[430px] z-0">
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/3 flex flex-col gap-6">
            <div class="card bg-base-100 shadow-xl w-full">
                <div class="card-body">
                    <div class="card-title">
                        Kepala Sekolah
                    </div>
                    @empty($kepsek)
                        <div class="italic text-sm text-gray-300">Data belum tersedia</div>
                    @else
                        <div class="flex flex-row space-x-4 py-4">
                            <div class="avatar">
                                <div class="mask mask-squircle w-16 h-16">
                                    <img src="{{ $kepsek->user->avatar_url }}" alt="{{ $kepsek->nama }}" />
                                </div>
                            </div>
                            <div>
                                <div class="uppercase">{{ $kepsek->nama }}</div>
                                <div class="text-xs">NIP : {{ $kepsek->nip }}</div>
                                <div class="text-xs">NUPTK : {{ $kepsek->nuptk }}</div>
                            </div>
                        </div>
                    @endempty
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl w-full h-96">
                <div class="card-body">
                    <div class="card-title">Grafik Guru & Tendik</div>
                    @empty($gtks)
                        <div class="italic text-sm text-gray-300">Data belum tersedia</div>
                    @else
                        <livewire:livewire-pie-chart :pie-chart-model="$chartGtk" />
                    @endempty
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="w-full">
            <div class="card bg-base-100 shadow-xl w-full">
                <div class="card-body">
                    <div class="card-title">Data Guru & Tenaga Kependidikan</div>
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
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
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nip }}</td>
                                        <td>{{ $item->nuptk }}</td>
                                        <td>
                                            {{ $item->status_kepegawaian }}
                                        </td>
                                        <td>{{ $item->no_telp }}</td>
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
                        {!! $gtks->onEachSide(5)->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    var mark = @js($sekolah['geo_lokasi']);

    let popUpContent = `<div class="font-semibold">${@js($sekolah['npsn'])} - ${@js($sekolah['nama'])}</div>` +
        `<div>Alamat : ${@js($sekolah['alamat'])}</div>` +
        `<div>Kode Pos : ${@js($sekolah['kode_pos'])}</div>` +
        `<div>Desa : ${@js($sekolah['desa'])}</div>` +
        `<div>Kecamatan : ${@js($sekolah['kecamatan'])}</div>`;

    // Defining an icon class
    var sekolahIcon = L.Icon.extend({
        options: {
            iconSize: [48, 48], // Ukuran ikon marker
            iconAnchor: [24, 48], // Anchor untuk ikon
            shadowUrl: @js($shadowIcon), // URL untuk gambar shadow
            shadowSize: [48, 48], // Ukuran shadow
            shadowAnchor: [6, 48], // Anchor untuk shadow
            popupAnchor: [0, -48] // Anchor untuk popup
        }
    });

    var sekolahNegeriIcon = new sekolahIcon({
            iconUrl: @js($negeriIcon)
        }),
        sekolahSwastaIcon = new sekolahIcon({
            iconUrl: @js($swastaIcon)
        });

    var map = L.map('map').setView(mark, 17);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker(mark, {
        icon: markerIcon(@js($sekolah['status']))
    }).addTo(map);

    marker.bindPopup(popUpContent).openPopup();

    function markerIcon(params) {
        if (params === 'negeri') {
            return sekolahNegeriIcon;
        } else {
            return sekolahSwastaIcon;
        }
    }
</script>
