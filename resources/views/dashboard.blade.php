<x-app-layout>

    @section('title', 'Dashboard')

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-base-content dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="text-primary">Dashboard</li>
    </x-slot>

    <div class="grid grid-rows-4 lg:grid-cols-4 col-span-4 gap-4">
        <div class="card w-full bg-base-100 shadow-xl">
            <div class="card-body flex flex-row items-center justify-start gap-4">
                <x-icon-o-building-office-2 class="w-8 h-8 text-primary" />
                <div class="text-base-content">
                    <h2 class="text-lg">Sekolah</h2>
                    <p class="text-2xl font-black">88</p>
                </div>
            </div>
        </div>
        <div class="card w-full bg-base-100 shadow-xl">
            <div class="card-body flex flex-row items-center justify-start gap-4">
                <x-icon-o-building-office-2 class="w-8 h-8 text-primary" />
                <div class="text-base-content">
                    <h2 class="text-lg">Kepala Sekolah</h2>
                    <p class="text-2xl font-black">88</p>
                </div>
            </div>
        </div>
        <div class="card w-full bg-base-100 shadow-xl">
            <div class="card-body flex flex-row items-center justify-start gap-4">
                <x-icon-o-user-group class="w-8 h-8 text-primary" />
                <div class="text-base-content">
                    <h2 class="text-lg">Guru</h2>
                    <p class="text-2xl font-black">250</p>
                </div>
            </div>
        </div>
        <div class="card w-full bg-base-100 shadow-xl">
            <div class="card-body flex flex-row items-center justify-start gap-4">
                <x-icon-o-user-group class="w-8 h-8 text-primary" />
                <div class="text-base-content">
                    <h2 class="text-lg">Tendik</h2>
                    <p class="text-2xl font-black">88</p>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
