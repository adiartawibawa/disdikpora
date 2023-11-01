<div wire:ignore>
    <div id="map" class="h-[100vh] w-full z-0 rounded-md"></div>
</div>

<script>
    var map = L.map('map').setView([@js($lat), @js($lon)], @js($zoom));
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // var marker = L.marker([-8.6042279, 115.1761774]).addTo(map);

    // marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
</script>
