<div>
    <div wire:ignore class="z-[100] w-auto h-[250px]"></div>
    <script>
        var map = L.map('map').setView([-8.613688, 115.186933], 19);

        var marker = L.marker([-8.613688, 115.186933]).addTo(map);
        marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        console.log(map);
    </script>
</div>
