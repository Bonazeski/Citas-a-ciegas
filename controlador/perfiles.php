<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /citasaciegas/controlador/iniciarsesion.php');
    exit();
}

require_once __DIR__ . '/../modelo/crud_perfil.php';
require_once __DIR__ . '/../modelo/crud_provincias.php';
require_once __DIR__ . '/../modelo/crud_departamentos.php';
require_once __DIR__ . '/../modelo/crud_sexos.php';
require_once __DIR__ . '/../modelo/crud_generos.php';
require_once __DIR__ . '/../modelo/crud_orientacionessexuales.php';
require_once __DIR__ . '/../modelo/crud_tiempolibre.php';
require_once __DIR__ . '/../modelo/crud_citaideal.php';
require_once __DIR__ . '/../modelo/crud_relacionespersonales.php';
require_once __DIR__ . '/../modelo/crud_estilosdevida.php';
require_once __DIR__ . '/../modelo/crud_motivacionesdeldia.php';
require_once __DIR__ . '/../modelo/crud_citas.php'; // ← NECESARIO para saber estados de citas

// Captura de filtros
$filtros = [
    'provincia'     => $_GET['provincia'] ?? '',
    'departamento'  => $_GET['departamento'] ?? '',
    'sexo'          => $_GET['sexo'] ?? '',
    'genero'        => $_GET['genero'] ?? '',
    'orientacion'   => $_GET['orientacion'] ?? '',
    'tiempoLibre'   => $_GET['tiempoLibre'] ?? '',
    'citaIdeal'     => $_GET['citaIdeal'] ?? '',
    'relacion'      => $_GET['relacion'] ?? '',
    'estilo'        => $_GET['estilo'] ?? '',
    'motivacion'    => $_GET['motivacion'] ?? '',
];

$provincias = obtenerprovincias();
$departamentos = !empty($filtros['provincia']) ? obtenerdepartamentos_por_provincia($filtros['provincia']) : [];
$departamentosTodos = obtenerdepartamentos();

$sexos = obtenersexos();
$generos = obtenergeneros();
$orientaciones = obtenerorientacionessexuales();
$tiemposLibres = obtenertiempolibre();
$citasIdeales = obtenercitaideal();
$relaciones = obtenerrelacionespersonales();
$estilosDeVida = obtenerestilosvida();
$motivaciones = obtenermotivacionesdeldia();

$idusuario = $_SESSION['usuario_id'];
$idperfil = obteneridperfil($idusuario);

// ===============================
// SABER SI EL USUARIO TIENE CITA ACTIVA
// ===============================
$citasUsuario = obtenercitasusuario($idusuario);

$tieneCitaActiva = false;
foreach ($citasUsuario as $c) {
    if ($c['estadocita'] == 2 || $c['estadocita'] == 3) {
        $tieneCitaActiva = true;
        break;
    }
}

// Perfiles filtrados
$hayFiltros = false;
foreach ($filtros as $valor) {
    if (!empty($valor)) {
        $hayFiltros = true;
        break;
    }
}

if ($hayFiltros) {
    $perfiles = obtenerperfilesfiltrados($filtros, $idperfil);
} else {
    $perfiles = [];
}

include __DIR__ . '/../vista/inicio/perfiles/index.php';
?>