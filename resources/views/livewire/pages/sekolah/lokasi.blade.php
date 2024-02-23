<div>
    <div id="map" class="w-full h-60 z-0" x-data="{
        init() {
            const map = L.map('map').setView([-8.6042279, 115.1761774], {{ $this->zoomLevel }});
    
            // Tambahkan tile layer OpenStreetMap ke dalam map
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: `<a href='http://www.openstreetmap.org/copyright'>OpenStreetMap</a>`
            }).addTo(map);
    
            // Tambahkan layer sekolah
            const layerSekolah = addSekolahLayer();
            addSekolahPopups(layerSekolah); // Tambahkan pop-up untuk layer sekolah
    
            // Tambahkan marker cluster untuk layer sekolah
            const markerSekolah = L.markerClusterGroup().addLayer(layerSekolah);
            map.addLayer(markerSekolah);
            {{-- map.fitBounds(markerSekolah.getBounds()); --}}
    
            // Fungsi untuk menambahkan layer sekolah
            function addSekolahLayer() {
                const sekolah = {{ $this->geojson }};
                const layerSekolah = L.geoJSON(sekolah, {
                    pointToLayer: function(feature, latlng) {
                        const iconUrl = feature.properties.icon;
                        const icon = L.icon({
                            iconUrl: iconUrl,
                            iconSize: [50, 50],
                            iconAnchor: [25, 50],
                            className: 'bounce'
                        });
                        return L.marker(latlng, {
                            icon: icon
                        });
                    },
                });
    
                return layerSekolah;
            }
    
            // Fungsi untuk menambahkan pop-up ke layer sekolah
            function addSekolahPopups(layerSekolah) {
                layerSekolah.eachLayer(function(layer) {
                    const properties = layer.feature.properties;
                    const popupContent = `<div class='mb-4 text-xl font-semibold'>${properties.nama}</div>` +
                        `<div class=''>NPSN : ${properties.npsn}</div>` +
                        `<div class=''>Status : ${properties.status}</div>` +
                        `<div class=''>Alamat : ${properties.alamat}</div>`;
                    layer.bindPopup(popupContent);
                });
            }
        }
    }" wire:ignore />
</div>

{{-- <script>
    // Fungsi untuk inisialisasi map
    function initMap() {
        const map = L.map('map').setView([-8.6042279, 115.1761774], {{ $this->zoomLevel }});

        // Tambahkan tile layer OpenStreetMap ke dalam map
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: `<a href='http://www.openstreetmap.org/copyright'>OpenStreetMap</a>`
        }).addTo(map);

        // Tambahkan layer sekolah
        const layerSekolah = addSekolahLayer();
        addSekolahPopups(layerSekolah); // Tambahkan pop-up untuk layer sekolah

        // Tambahkan marker cluster untuk layer sekolah
        const markerSekolah = L.markerClusterGroup().addLayer(layerSekolah);
        map.addLayer(markerSekolah);
        map.fitBounds(markerSekolah.getBounds());

        // Objek yang akan digunakan oleh x-data pada div#map
        return {
            initMap: initMap // Return fungsi initMap untuk digunakan oleh x-data
        };
    }

    // Fungsi untuk menambahkan layer sekolah
    function addSekolahLayer() {
        const sekolah = {!! $this->geojson !!};
        const layerSekolah = L.geoJSON(sekolah, {
            pointToLayer: function(feature, latlng) {
                const iconUrl = feature.properties.icon;
                const icon = L.icon({
                    iconUrl: iconUrl,
                    iconSize: [50, 50],
                    iconAnchor: [25, 50],
                    className: 'bounce'
                });
                return L.marker(latlng, {
                    icon: icon
                });
            },
        });

        return layerSekolah;
    }

    // Fungsi untuk menambahkan pop-up ke layer sekolah
    function addSekolahPopups(layerSekolah) {
        layerSekolah.eachLayer(function(layer) {
            const properties = layer.feature.properties;
            const popupContent = `<div class='mb-4 text-xl font-semibold'>${properties.nama}</div>` +
                `<div class=''>NPSN : ${properties.npsn}</div>` +
                `<div class=''>Status : ${properties.status}</div>` +
                `<div class=''>Alamat : ${properties.alamat}</div>`;
            layer.bindPopup(popupContent);
        });
    }
</script> --}}
