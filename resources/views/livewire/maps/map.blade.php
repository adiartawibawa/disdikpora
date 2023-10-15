<div>
    <div wire:ignore id="map" style="width: 100%; height: 100vh;" class="z-0"></div>

    <script>
        var map = L.map('map').setView([@js($latitude), @js($longitude)], @js($zoom));

        var marker = L.marker([@js($latitude), @js($longitude)]).addTo(map);
        marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
    </script>
</div>
