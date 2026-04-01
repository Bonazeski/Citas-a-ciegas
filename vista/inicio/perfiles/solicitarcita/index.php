<?php
include_once(__DIR__ . '/../../../../controlador/seguridad.php');
require_once(__DIR__ . '/../../../../config/bootstrap.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/citasaciegas/vista/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/citasaciegas/vista/csspersonalizado/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Solicitar cita | Citas a ciegas</title>
</head>
<body>
    <main class="container py-5">
        <h1 class="mb-4">Organizar cita</h1>
        <p class="alert alert-warning">Párrafo de concientización como alerta.</p>

        <form action="/citasaciegas/controlador/solicitarcita.php" method="POST">
            <div class="form-group mb-4">
                <label class="form-label fw-bold">Punto de Encuentro</label>
                <div id="mapa-encuentro" style="height: 400px; width: 100%; border: 1px solid #ccc; border-radius: 4px;"></div>
                <small class="form-text text-muted">Haga clic en el mapa o arrastre el marcador hasta la ubicación exacta de la cita.</small>
            </div>
            <input type="hidden" name="receptor" value="<?= htmlspecialchars($receptor) ?>">

            <!-- Campos ocultos donde guardamos las coordenadas -->
            <input type="hidden" id="latitud_oculta" name="latitud_encuentro" value="">
            <input type="hidden" id="longitud_oculta" name="longitud_encuentro" value="">
            <!-- DATOS DEL LUGAR -->
            <input type="hidden" id="place_name" name="place_name">
            <input type="hidden" id="place_address" name="place_address">
            <input type="hidden" id="place_id" name="place_id">

            
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" id="fecha" class="form-control" name="fecha" required>
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora Estimada</label>
                <input type="time" id="hora" class="form-control" name="hora" required>
            </div>
            <div class="mb-4">
                <label for="detalle" class="form-label">Detalle de la Cita</label>
                <input type="text" id="detalle" class="form-control" name="detalle" required placeholder="Ej: Esquina de la cafetería 'El Encuentro'">
            </div>

            <button type="submit" class="btn btn-primary w-100">Solicitar cita</button>
        </form>


    </main>
<script async src="https://maps.googleapis.com/maps/api/js?key=<?= htmlspecialchars($_ENV['GOOGLE_MAPS_API_KEY']) ?>&libraries=places&callback=initMap"></script>
<script>
const latInput = document.getElementById('latitud_oculta');
const lngInput = document.getElementById('longitud_oculta');
const nameInput = document.getElementById('place_name');
const addressInput = document.getElementById('place_address');
const placeIdInput = document.getElementById('place_id');

function initMap() {
    const posicionInicial = { lat: -34.6037, lng: -58.3816 };

    const mapa = new google.maps.Map(document.getElementById('mapa-encuentro'), {
        zoom: 12,
        center: posicionInicial,
        mapTypeId: 'roadmap'
    });

    const geocoder = new google.maps.Geocoder();

    const marcador = new google.maps.Marker({
        position: posicionInicial,
        map: mapa,
        draggable: true
    });

    function actualizarDatos(latLng) {
        const lat = latLng.lat();
        const lng = latLng.lng();

        latInput.value = lat;
        lngInput.value = lng;

        // Reverse lookup: obtener nombre y dirección
        geocoder.geocode({ location: { lat, lng } }, function(results, status) {
            if (status === "OK" && results[0]) {

                let name = "";
                let address = results[0].formatted_address;
                let placeId = results[0].place_id || "";

                // Buscar nombre comercial si existe en los types del place
                for (let result of results) {
                    if (result.types.includes("establishment")) {
                        name = result.formatted_address.split(",")[0];
                        break;
                    }
                }

                // Guardar datos
                nameInput.value = name || "";
                addressInput.value = address;
                placeIdInput.value = placeId;
            }
        });
    }

    marcador.addListener('dragend', function () {
        actualizarDatos(marcador.getPosition());
    });

    mapa.addListener('click', function (e) {
        marcador.setPosition(e.latLng);
        actualizarDatos(e.latLng);
    });

    actualizarDatos(posicionInicial);
}
</script>

<script src="/citasaciegas/vista/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>