@extends('layouts.landing')

@section('page-content')
    {{-- section layanan --}}
    <section id="beranda" class="flex flex-col items-center h-full justify-center" x-show="activeTab === 1"
        x-transition:enter="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-700 transform order-first"
        x-transition:enter-start="opacity-0 -translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-300 transform absolute"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-12">
        <div class="pt-24">
            <livewire:welcome.beranda />
        </div>
    </section>

    {{-- section panduan --}}
    <section id="panduan" class="flex flex-col items-center h-full justify-center" x-show="activeTab === 2"
        x-transition:enter="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-700 transform order-first"
        x-transition:enter-start="opacity-0 -translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-300 transform absolute"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-12">
        <div class="py-20">
            <livewire:welcome.daftar-layanan />
        </div>
    </section>
@endsection

@section('map')
    <aside class="w-full md:w-[30%]">
        <div class="z-10 sticky">
            <livewire:welcome.sekolah.peta-sekolah />
        </div>
    </aside>
@endsection
