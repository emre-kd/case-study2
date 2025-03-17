<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Route</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        .custom-marker {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid white;
        }
        .color-box {
            width: 20px;
            height: 20px;
            display: inline-block;
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    Latitude of Location 1: {{$location1->latitude}}<br>
    Longitude of Location 1: {{$location1->longitude}}<br>
    <div class="color-box" style="background-color: {{$location1->color}};"></div><br>
    <br>
    Latitude of Location 2: {{$location2->latitude}}<br>
    Longitude of Location 2: {{$location2->longitude}}<br>
    <div class="color-box" style="background-color: black;"></div><br>
    <p>Distance Between Locations (Km): <span id="distance"></span></p>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([{{$location1->latitude}}, {{$location1->longitude}}], 2);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        function createCustomMarker(lat, lng, color, name) {
            var customIcon = L.divIcon({
                className: '',
                html: `<div class='custom-marker' style='background-color: ${color};'></div>`
            });
            return L.marker([lat, lng], {icon: customIcon}).addTo(map).bindPopup(`<b>${name}</b>`);
        }

        createCustomMarker({{$location1->latitude}}, {{$location1->longitude}}, "{{$location1->color}}", "{{$location1->name}}");
        createCustomMarker({{$location2->latitude}}, {{$location2->longitude}}, "black", "Your Location");

        var route = [
            [{{$location1->latitude}}, {{$location1->longitude}}],
            [{{$location2->latitude}}, {{$location2->longitude}}]
        ];
        var polyline = L.polyline(route, {color: 'gray'}).addTo(map);
        map.fitBounds(polyline.getBounds());

        var latLng1 = L.latLng({{$location1->latitude}}, {{$location1->longitude}});
        var latLng2 = L.latLng({{$location2->latitude}}, {{$location2->longitude}});
        var distanceInKm = (latLng1.distanceTo(latLng2) / 1000).toFixed(2);
        document.getElementById('distance').innerText = distanceInKm + " km";
    </script>
</body>
</html>
