<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /citasaciegas/controlador/iniciarsesion.php');
    exit();
}
$usuario_receptor = isset($_GET['receptor']) ? $_GET['receptor'] : null;
require_once __DIR__ . '/../modelo/crud_citas.php';
require_once __DIR__ . '/../modelo/crud_perfil.php';

// RECIBE EL PERFIL RECEPTOR DESDE LA URL
$usuario_receptor =  $_GET['receptor'] ?? $_POST['receptor'] ?? null;



if (!$usuario_receptor) {
    echo "No se recibió el perfil receptor.";
}

// OBTENER EL PERFIL DEL USUARIO LOGUEADO
$usuario_solicitante = $_SESSION['usuario_id'];

$receptor = $usuario_receptor;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // COORDENADAS
    $latitud = $_POST['latitud_encuentro'];
    $longitud = $_POST['longitud_encuentro'];

    // DATOS DEL LUGAR (NUEVO)
    $place_name = $_POST['place_name'] ?? null;
    $place_address = $_POST['place_address'] ?? null;
    $place_id = $_POST['place_id'] ?? null;

    // FECHA, HORA Y DETALLE
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $detalle = $_POST['detalle'];

    $estado = 1; // "En proceso"

    // AHORA INSERTAMOS TAMBIÉN EL NOMBRE, DIRECCIÓN Y PLACE ID
    $resultado = insertarcita(
        $usuario_solicitante,
        $receptor,
        $fecha,
        $hora,
        $latitud,
        $longitud,
        $place_name,
        $place_address,
        $place_id,
        $detalle,
        $estado,
        $usuario_solicitante
    );

    if ($resultado) {
        echo "<script>
            alert('La solicitud de cita se envió correctamente');
            window.location.href='/citasaciegas/controlador/miscitas.php';
        </script>";
        exit();
    } else {
        echo "Error al enviar la solicitud.";
        exit();
    }
}

include_once __DIR__ . '/../vista/inicio/perfiles/solicitarcita/index.php';
?>
