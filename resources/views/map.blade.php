<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map with Laravel</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body>
    <h1>Pilih Lokasi di Peta</h1>
    <div id="map" style="height: 500px;"></div>

    <form action="{{ route('map.store') }}" method="POST">
        @csrf
        <label>Nama Lokasi:</label>
        <input type="text" name="name" required>
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
        <button type="submit">Simpan Lokasi</button>
    </form>

    <script>
        var map = L.map('map').setView([-8.796336794163464, 115.17634352121057], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker;

        var locations = @json($locations);
        locations.forEach(function(location) {
            L.marker([location.latitude, location.longitude])
                .addTo(map)
                .bindPopup(`<b>${location.name}</b><br>Lat: ${location.latitude}, Lng: ${location.longitude}`);
        });

        function onMapClick(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(map);
            document.getElementById("latitude").value = e.latlng.lat;
            document.getElementById("longitude").value = e.latlng.lng;
        }

        map.on('click', onMapClick);
    </script>
</body>
</html>
