<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /citasaciegas/controlador/iniciarsesion.php');
    exit();
}

require_once __DIR__ . '/../modelo/crud_perfil.php';
require_once __DIR__ . '/../modelo/crud_usuario.php';

require_once __DIR__ . '/../modelo/crud_sexos.php';
require_once __DIR__ . '/../modelo/crud_generos.php';
require_once __DIR__ . '/../modelo/crud_orientacionessexuales.php';
require_once __DIR__ . '/../modelo/crud_provincias.php';
require_once __DIR__ . '/../modelo/crud_departamentos.php';

require_once __DIR__ . '/../modelo/crud_tiempolibre.php';
require_once __DIR__ . '/../modelo/crud_citaideal.php';
require_once __DIR__ . '/../modelo/crud_relacionespersonales.php';
require_once __DIR__ . '/../modelo/crud_estilosdevida.php';
require_once __DIR__ . '/../modelo/crud_motivacionesdeldia.php';

$idusuario = $_SESSION['usuario_id'];

$perfil = obtenerperfilporidusuario($idusuario);
$usuario = obtenerdatosusuario($_SESSION['usuario_nombre']);

$sexoperfil = obtenersexodeperfil($idusuario);
$generoperfil = obtenergenerodeperfil($idusuario);
$orientacionperfil = obtenerorientacionsexualdeperfil($idusuario);
$provinciaperfil = obtenerprovinciadeperfil($perfil['idprovincia']);
$departamentoperfil = obtenerdepartamentodeperfil($perfil['iddepa']);

$tiempolibreperfil = obtenertiempolibredeperfil($idusuario);
$citaidealperfil = obtenercitaidealdeperfil($idusuario);
$relacionespersonalesperfil = obtenerrelacionespersonalesdeperfil($idusuario);
$estilosdevidaperfil = obtenerestilodevidadeperfil($idusuario);
$motivacionesdeldiaperfil = obtenermotivaciondeldiadeperfil($idusuario);  


$gustosypreferencias = [];

// Verificamos si hay algún dato de gustos y preferencias cargado
if (!empty($perfil['id_tiempo_libre'])) 
{
   $gustosypreferencias[] = "En mi tiempo libre me gusta: " . $tiempolibreperfil['actividad'];
}
if (!empty($perfil['id_cita_ideal'])) 
{
    $gustosypreferencias[] = "Para mi una cita ideal sería: " . $citaidealperfil['cita_ideal'];
}
if (!empty($perfil['id_relacion'])) 
{
    $gustosypreferencias[] = "Creo que algo importante en una relacion es " .$relacionespersonalesperfil['descripcion_relacion'];
}
if (!empty($perfil['id_estilo'])) 
{
    $gustosypreferencias[] = "Suelo llevar un estilo de vida " . $estilosdevidaperfil['estilo_de_vida'];
}
if (!empty($perfil['id_motivacion'])) 
{
    $gustosypreferencias[] = "Podría decir que mi motivacion es " . $motivacionesdeldiaperfil['posible_respuesta'];
}

// Si no hay ningún gusto cargado, mostrar mensaje por defecto
if (empty($gustosypreferencias)) 
{
    $gustosypreferencias[] = "Aún no se han calificado datos de interés";
}

// Ruta correcta desde la carpeta /controlador hacia la vista
include __DIR__ . '/../vista/inicio/miperfil/index.php';
?>
