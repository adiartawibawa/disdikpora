<div>
    <div wire:ignore id="maps" class="absolute w-full h-full" />
</div>

<script>
    mapboxgl.accessToken =
        'pk.eyJ1Ijoic2hpbm9kYTkxIiwiYSI6ImNsbnF3MW51cDE5dG8yaW1wcW9pdDU4N24ifQ.-eZB_ZMNUI_T1lZ396AEqQ';
    const map = new mapboxgl.Map({
        container: 'maps', // container ID
        // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
        style: 'mapbox://styles/mapbox/streets-v12', // style URL
        center: [@js($lon), @js($lat)], // starting position [lng, lat]
        zoom: 9 // starting zoom
    });
</script>
