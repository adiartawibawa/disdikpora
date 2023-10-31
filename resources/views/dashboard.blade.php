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

    <div class="flex-none">
        <div class="flex flex-col md:flex-row w-full gap-4">
            <div class="md:w-1/2 w-full">
                <div class="card w-full bg-base-100 shadow-xl">
                    <livewire:components.maps.map />
                </div>
            </div>
            <div class="md:w-1/2 w-full h-full">
                <div class="flex flex-col items-center gap-4">
                    <livewire:components.stats.sekolah />
                    <livewire:components.stats.grafik-sekolah />
                </div>
            </div>
        </div>
        <div class="grid md:grid-cols-3 col-span-3 gap-4 mt-8 w-full">

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
    </div>

</x-app-layout>
