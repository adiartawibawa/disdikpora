<div wire:ignore>
    {{-- Do your work, then step back. --}}
</div>

<script>
    const sekolah = JSON.parse(@js($sekolah))

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

    function onEachFeature(feature, layer) {
        let popupContent = '';

        if (feature.properties && feature.properties.name) {
            popupContent += `<div class="mb-4 text-xl font-semibold">${feature.properties.name}</div>`;
        }

        popupContent += `<div class="">NPSN : ${feature.properties.npsn}</div>` +
            `<div class="">Status : ${feature.properties.status}</div>` +
            `<div class="">Alamat : ${feature.properties.alamat}</div>` +
            `<div class="">Kode Pos : ${feature.properties.kode_pos}</div>` +
            `<div class="">Desa : ${feature.properties.desa}</div>` +
            `<div class="">Kecamatan : ${feature.properties.kecamatan}</div>` +
            `<a href="${feature.properties.url}" target="_blank" class="btn btn-xs btn-ghost mt-4">detail</a>`;

        layer.bindPopup(popupContent);
    }

    const geojson = L.geoJSON(sekolah, {
        onEachFeature: onEachFeature,
        pointToLayer: function(feature, latlng) {
            if (feature.properties.status === 'Negeri') {
                return L.marker(latlng, {
                    icon: sekolahNegeriIcon
                });
            } else {
                return L.marker(latlng, {
                    icon: sekolahSwastaIcon
                });
            }
        }
    });

    const markerSekolah = L.markerClusterGroup().addLayer(geojson);

    map.addLayer(markerSekolah);
    map.fitBounds(markerSekolah.getBounds());
</script>
