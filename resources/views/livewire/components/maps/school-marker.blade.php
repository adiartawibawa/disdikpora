<div wire:ignore>
    {{-- Do your work, then step back. --}}
</div>

<script>
    const sekolah = JSON.parse(@js($sekolah))

    function onEachFeature(feature, layer) {
        let popupContent = '';

        if (feature.properties && feature.properties.name) {
            popupContent += `<div class="mb-4 text-xl font-semibold">${feature.properties.name}</div>`;
        }

        popupContent += `<div class="btn btn-xs btn-primary">detail</div>`

        layer.bindPopup(popupContent);
    }

    const geojson = L.geoJSON(sekolah, {
        onEachFeature: onEachFeature
    });

    const markerSekolah = L.markerClusterGroup().addLayer(geojson);

    map.addLayer(markerSekolah);
    map.fitBounds(markerSekolah.getBounds());
</script>
