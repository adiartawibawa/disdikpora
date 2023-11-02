@section('title', $sekolah->nama)

<x-slot name="header">
    <h2 class="font-semibold text-2xl text-base-content dark:text-gray-200 leading-tight">
        {{ __('Sekolah') }}
    </h2>
</x-slot>

<x-slot name="breadcrumbs">
    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('sekolah.all') }}">Sekolahs</a></li>
    <li class="text-primary">{{ $sekolah->nama }}</li>
</x-slot>

<div>
    <section class="flex md:flex-row flex-col w-full mb-6 gap-6">
        <div class="w-full md:w-2/3">
            <div class="card bg-base-100 shadow-xl w-full">
                <div class="card-body">
                    {{ $sekolah->lokasi->latitude }}
                    {{ $sekolah->lokasi->longitude }}
                    <div class="card-actions">
                        {{ $sekolah }}
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/3 flex flex-col gap-6">
            <div class="card bg-base-100 shadow-xl w-full">
                <div class="card-body">
                    @foreach ($sekolah->gtk as $item)
                        @if ($item->is_kepsek)
                            {{ $item->nama }}
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl w-full">
                <div class="card-body">
                    a
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl w-full">
                <div class="card-body">
                    a
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="flex md:flex-row flex-col w-full mb-6 gap-6">
        <div class="w-full flex flex-col gap-6 md:w-2/6">
            <div class="card bg-base-100 shadow-xl w-full">
                <div class="card-body">
                    a
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl w-full">
                <div class="card-body">
                    a
                </div>
            </div>
            <div class="card bg-base-100 shadow-xl w-full">
                <div class="card-body">
                    a
                </div>
            </div>
        </div>
        <div class="w-full md:w-4/6">
            <div class="card bg-base-100 shadow-xl w-full h-full">
                <div class="card-body">
                    <div class="carousel w-full">
                        <div id="slide1" class="carousel-item relative w-full">
                            <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&q=60&w=500&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2Nob29sfGVufDB8MHwwfHx8MA%3D%3D"
                                class="w-full" />
                            <div
                                class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                                <a href="#slide4" class="btn btn-circle">❮</a>
                                <a href="#slide2" class="btn btn-circle">❯</a>
                            </div>
                        </div>
                        <div id="slide2" class="carousel-item relative w-full">
                            <img src="https://images.unsplash.com/photo-1494949649109-ecfc3b8c35df?auto=format&fit=crop&q=60&w=500&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fHNjaG9vbHxlbnwwfDB8MHx8fDA%3D"
                                class="w-full" />
                            <div
                                class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                                <a href="#slide1" class="btn btn-circle">❮</a>
                                <a href="#slide3" class="btn btn-circle">❯</a>
                            </div>
                        </div>
                        <div id="slide3" class="carousel-item relative w-full">
                            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&q=60&w=500&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8c2Nob29sfGVufDB8MHwwfHx8MA%3D%3D"
                                class="w-full" />
                            <div
                                class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                                <a href="#slide2" class="btn btn-circle">❮</a>
                                <a href="#slide4" class="btn btn-circle">❯</a>
                            </div>
                        </div>
                        <div id="slide4" class="carousel-item relative w-full">
                            <img src="https://images.unsplash.com/photo-1594608661623-aa0bd3a69d98?auto=format&fit=crop&q=60&w=500&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fHNjaG9vbHxlbnwwfDB8MHx8fDA%3D"
                                class="w-full" />
                            <div
                                class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                                <a href="#slide3" class="btn btn-circle">❮</a>
                                <a href="#slide1" class="btn btn-circle">❯</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
</div>
