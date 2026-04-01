<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /citasaciegas/controlador/iniciarsesion.php');
    exit();
}

require_once __DIR__ . '/../modelo/crud_citas.php';

$idusuario = $_SESSION['usuario_id'];
$alerta = "";

// OBTENER CITAS
$citas = obtenercitasusuario($idusuario);

// MARCA SI TIENE CITA PENDIENTE O ACEPTADA
$tieneCitaActiva = false;
foreach ($citas as $c) {
    if ($c['estadocita'] == 2 || $c['estadocita'] == 3) {
        $tieneCitaActiva = true;
        break;
    }
}

// MARCA SI TIENE ALGUNA SOLICITUD (estado 1)
$haySolicitud = false;
foreach ($citas as $c) {
    if ($c['estadocita'] == 1) {
        $haySolicitud = true;
        break;
    }
}

// ACCIONES POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {

    $accion = $_POST['accion'];
    $idcita = intval($_POST['idcita']);

    foreach ($citas as $ci) {
        if ($ci['id_cita'] == $idcita) {
            $citaActual = $ci;
            break;
        }
    }

    $soyEmisor = ($citaActual['perfil1'] == $idusuario);
    $soyReceptor = ($citaActual['perfil2'] == $idusuario);

    if ($accion === "aceptar_inicial") {
        if (!$soyReceptor) {
            $alerta = "<div class='alert alert-danger'>No podés aceptar tu propia solicitud.</div>";
        } elseif ($tieneCitaActiva) {
            $alerta = "<div class='alert alert-warning'>Ya tenés una cita activa.</div>";
        } else {
            cambiarEstadoCita($idcita, 2);
            $alerta = "<div class='alert alert-success'>Aceptaste la solicitud.</div>";
            $tieneCitaActiva = true;
        }
    }

    if ($accion === "aceptar_definitivo") {

        if ($citaActual['propuesta_por'] == $idusuario) {
            $alerta = "<div class='alert alert-warning'>
                No podés aceptar tu propia propuesta. Esperá la respuesta del otro usuario.
            </div>";
        } else {
            cambiarEstadoCita($idcita, 3);
            $alerta = "<div class='alert alert-info'>La cita quedó aceptada.</div>";
            $tieneCitaActiva = true;
        }
    }

    if ($accion === "cancelar") {
        cambiarEstadoCita($idcita, 4);
        $alerta = "<div class='alert alert-info'>Cancelaste la cita.</div>";
        $tieneCitaActiva = false;
    }

    $citas = obtenercitasusuario($idusuario);
}

// GOOGLE PLACES
$apiKey = "AIzaSyD2daqt-ds5rAOzWIzebNdAyS4CEM6opDM";

function obtenerNombreLugar($lat, $lng, $apiKey) {

    $urlNearby = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?"
    . "location={$lat},{$lng}&radius=0&type=cafe|restaurant|bar|bakery|food|park|movie_theater|museum|library|shopping_mall|tourist_attraction&key={$apiKey}";
    $responseNearby = @file_get_contents($urlNearby);
    $dataNearby = json_decode($responseNearby, true);

    if (!empty($dataNearby['results'][0]['name'])) {
        return $dataNearby['results'][0]['name'];
    }

    $urlGeo = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$lat},{$lng}&key={$apiKey}";
    $responseGeo = @file_get_contents($urlGeo);
    $dataGeo = json_decode($responseGeo, true);

    if (!empty($dataGeo['results'][0]['formatted_address'])) {
        return $dataGeo['results'][0]['formatted_address'];
    }

    return "Ubicación no disponible";
}

// COMPLETAR DATOS Y LÓGICA DE CADA CITA
foreach ($citas as &$cita) {

    $cita['soyEmisor']   = ($cita['perfil1'] == $idusuario);
    $cita['soyReceptor'] = ($cita['perfil2'] == $idusuario);
    $cita['ultimoPropusoSoyYo'] = ($cita['propuesta_por'] == $idusuario);

    $cita['puedoVerDetalles'] =
        $cita['estadocita'] == 3 ||
        $cita['soyEmisor'] ||
        $cita['ultimoPropusoSoyYo'] ||
        ($cita['soyReceptor'] && $cita['estadocita'] == 2);

    if (($cita['estadocita'] == 2 || $cita['estadocita'] == 3)
        && !empty($cita['latitud'])
        && !empty($cita['longitud'])) {

        $cita['place_nombre'] = obtenerNombreLugar($cita['latitud'], $cita['longitud'], $apiKey);
    } else {
        $cita['place_nombre'] = null;
    }
}
unset($cita);

// VISTA
include __DIR__ . '/../vista/inicio/citas/index.php';