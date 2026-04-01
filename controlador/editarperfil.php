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

$idusuario = $_SESSION['usuario_id'];

$perfil = obtenerperfilporidusuario($_SESSION['usuario_id']);
// Cargar datos para los selectores (siempre disponibles)
$sexoActual = $perfil['idsexo'];
$generoActual = $perfil['idgenero'];
$orientacionActual = $perfil['idorientacion'];
$provinciaActual = $perfil['idprovincia'];
$departamentoActual = $perfil['iddepa'];

// Cargar datos para los selectores (opcionales) el null es por si no estan seteados aun
$tiempoLibreActual = $perfil['id_tiempo_libre'] ?? null;
$citaIdealActual = $perfil['id_cita_ideal'] ?? null;
$relacionActual = $perfil['id_relacion'] ?? null;
$estiloActual = $perfil['id_estilo'] ?? null;
$motivacionActual = $perfil['id_motivacion'] ?? null;

$provincias = obtenerprovincias();
$departamentos = obtenerdepartamentos_por_provincia($provinciaActual);
$sexos = obtenersexos();
$generos = obtenergeneros();
$orientacionessexuales = obtenerorientacionessexuales();

$tiempolibre = obtenertiempolibre();
$citaideal = obtenercitaideal();
$relacionespersonales = obtenerrelacionespersonales();
$estilodevida = obtenerestilosvida();
$motivacionesdeldia = obtenermotivacionesdeldia();

$error = ""; // variable de error inicializada


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Limpiar y validar datos
   
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    

    $provincia_selector = isset($_POST['provincia']) ? trim($_POST['provincia']) : '';
    $departamento_selector = isset($_POST['departamento']) ? trim($_POST['departamento']) : '';

    $sexo = isset($_POST['sexo']) ? trim($_POST['sexo']) : '';
    $genero = isset($_POST['genero']) ? trim($_POST['genero']) : '';
    $orientacionsexual = isset($_POST['orientacion']) ? trim($_POST['orientacion']) : '';
    
    $tiempolibre = isset($_POST['tiempolibre']) ? trim($_POST['tiempolibre']) : '';
    $citaideal = isset($_POST['citaideal']) ? trim($_POST['citaideal']) : '';
    $relacionpersonal = isset($_POST['relacion']) ? trim($_POST['relacion']) : '';
    $estilodevida = isset($_POST['estilo']) ? trim($_POST['estilo']) : '';
    $motivaciondeldia = isset($_POST['motivacion']) ? trim($_POST['motivacion']) : '';  


    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';

    // --- Validaciones ---
    if (
        empty($nombre) || empty($apellido) || 
        empty($provincia_selector) || empty($departamento_selector) ||
        empty($sexo) || empty($genero) || empty($orientacionsexual)
    ) {
        $error = "Debe completar todos los campos obligatorios.";
        include __DIR__ . '/../vista/inicio/miperfil/editarperfil/index.php';
        exit();
    }

    
    // --- Inserción ---

// Solo actualizar si existe un usuario válido en sesión
    if ($idusuario) {
        $perfil_exitoso = editarperfilusuario(
            $idusuario,
            $provincia_selector,
            $departamento_selector,
            $sexo,
            $genero,
            $orientacionsexual,
            $tiempolibre,
            $citaideal,
            $relacionpersonal,
            $estilodevida,
            $motivaciondeldia,
            $descripcion
        );

        if ($perfil_exitoso) {
            header('Location: /citasaciegas/controlador/miperfil.php');
            exit();
        } else {
            $error = "Usuario creado, pero falló el perfil. Intente nuevamente.";
        }
    } else {
        $error = "Error al crear el usuario.";
    }
}
 


include __DIR__ . '/../vista/inicio/miperfil/editarperfil/index.php';
?>