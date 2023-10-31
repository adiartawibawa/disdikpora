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
            <div class="md:w-1/3 w-full">
                <div class="card w-full bg-base-100 shadow-xl">
                    <div id="map" class="h-[100vh] z-0"></div>
                </div>
            </div>
            <div class="md:w-2/3 w-full h-full">
                <div class="flex flex-col items-center gap-4">

                </div>
            </div>
        </div>
    </div>

    <script>
        var map = L.map('map').setView([-8.6042279, 115.1761774], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([-8.6042279, 115.1761774]).addTo(map);

        marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
    </script>

</x-app-layout>
