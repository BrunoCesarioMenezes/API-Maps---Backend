<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
</head>
<body class="flex items-center flex-col m-12 bg-neutral-800 text-white">
    <h1 class="font-bold text-xl">Testando mudança de posição no mapa</h1>
    <div class="flex flex-col gap-2 mt-4 border-white border-2 p-4 rounded-md w-fit">
        <p class="font-bold">Coordenadas:</p>
        <ul>
            <li id="lat">Carregando...</li>
            <li id="long">Carregando...</li>
        </ul>
        <div class="flex self-center h-[400px] w-[600px]
                    shadow-2xl shadow-neutral-950
                    border-2 border-neutral-950" id="map"></div>
    </div>
</body>
<script>
    const latElement = document.getElementById('lat');
    const longElement = document.getElementById('long');

    let map;
    let marker;

    async function updateCoordinates(){
        try{
            const response = await fetch('/api/coordinates');
            const data = await response.json();
            const lat = data.latitude;
            const lng = data.longitude;
            latElement.textContent = `Latitude: ${data.latitude}`;
            longElement.textContent = `Longitude: ${data.longitude}`;

            if (!map) {
                    map = L.map('map').setView([lat, lng], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(map);

                    marker = L.marker([lat, lng]).addTo(map)
                        .bindPopup(`Latitude: ${lat}<br>Longitude: ${lng}`)
                        .openPopup();
                } else {
                    marker.setLatLng([lat, lng])
                        .bindPopup(`Latitude: ${lat}<br>Longitude: ${lng}`)
                        .openPopup();

                    map.setView([lat, lng], map.getZoom());
                }
        }
        catch(error){
            console.error('Erro ao buscar coordenadas:', error);
            latElement.textContent = 'Erro ao carregar latitude';
            longElement.textContent = 'Erro ao carregar longitude';
        }
    }

    window.onload = function(){
        updateCoordinates();
    }
    setInterval(updateCoordinates, 5000);

</script>
</html>
