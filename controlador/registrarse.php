<?php
require_once __DIR__ . '/../modelo/crud_provincias.php';
require_once __DIR__ . '/../modelo/crud_departamentos.php';
require_once __DIR__ . '/../modelo/crud_sexos.php'; 
require_once __DIR__ . '/../modelo/crud_generos.php';
require_once __DIR__ . '/../modelo/crud_orientacionessexuales.php';

// Cargar datos para los selectores (siempre disponibles)
$provincias = obtenerprovincias();
$sexos = obtenersexos();
$generos = obtenergeneros();
$orientacionessexuales = obtenerorientacionessexuales();

$error = ""; // variable de error inicializada

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../modelo/crud_usuario.php';
    require_once __DIR__ . '/../modelo/crud_perfil.php';   

    // Limpiar y validar datos
    $nombreuser = isset($_POST['nombreuser']) ? trim($_POST['nombreuser']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $pass = isset($_POST['pass']) ? trim($_POST['pass']) : '';
    $pass2 = isset($_POST['pass2']) ? trim($_POST['pass2']) : '';
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $nacimiento = isset($_POST['nacimiento']) ? trim($_POST['nacimiento']) : '';
    $provincia_selector = isset($_POST['provincia']) ? trim($_POST['provincia']) : '';
    $departamento_selector = isset($_POST['departamento']) ? trim($_POST['departamento']) : '';
    $sexo = isset($_POST['sexo']) ? trim($_POST['sexo']) : '';
    $genero = isset($_POST['genero']) ? trim($_POST['genero']) : '';
    $orientacionsexual = isset($_POST['sexualidad']) ? trim($_POST['sexualidad']) : '';
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';

    // --- Validaciones ---
    if (
        empty($nombreuser) || empty($email) || empty($pass) || empty($pass2) ||
        empty($nombre) || empty($apellido) || empty($nacimiento) ||
        empty($provincia_selector) || empty($departamento_selector) ||
        empty($sexo) || empty($genero) || empty($orientacionsexual)
    ) {
        $error = "Debe completar todos los campos obligatorios.";
        include __DIR__ . '/../vista/registrarse/index.php';
        exit();
    }

    // Nombre de usuario duplicado
    $usuarios_existentes = obtenernombresusuarios();
    foreach ($usuarios_existentes as $usuario) {
        if ($usuario['user'] === $nombreuser) {
            $error = "El nombre de usuario ya está en uso. Por favor, elija otro.";
            include __DIR__ . '/../vista/registrarse/index.php';
            exit();
        }
    }

    // Formato del email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El correo electrónico no tiene un formato válido.";
        include __DIR__ . '/../vista/registrarse/index.php';
        exit();
    }

    // Contraseña
    if (strlen($pass) < 8) {
        $error = "La contraseña debe tener al menos 8 caracteres.";
        include __DIR__ . '/../vista/registrarse/index.php';
        exit();
    }

    if ($pass !== $pass2) {
        $error = "Las contraseñas no coinciden.";
        include __DIR__ . '/../vista/registrarse/index.php';
        exit();
    }

    // Fecha futura
    $fecha_actual = date('Y-m-d');
    if ($nacimiento > $fecha_actual) {
        $error = "La fecha de nacimiento no puede ser futura.";
        include __DIR__ . '/../vista/registrarse/index.php';
        exit();
    }

    // Mayor de edad
    $fecha_nacimiento = new DateTime($nacimiento);
    $hoy = new DateTime();
    $edad = $hoy->diff($fecha_nacimiento)->y;

    if ($edad < 18) {
        $error = "Debes tener al menos 18 años para registrarte.";
        include __DIR__ . '/../vista/registrarse/index.php';
        exit();
    }

    // --- Inserción ---
    $idusuario = insertuser($nombreuser, $email, $pass);

    if ($idusuario) {
        $perfil_exitoso = insertperfil(
            $nombre, $apellido, $nacimiento,
            $provincia_selector, $departamento_selector,
            $idusuario, $sexo, $genero, $orientacionsexual, $descripcion
        );

        if ($perfil_exitoso) {
            header('Location: ../vista/iniciarsesion/index.php');
            exit();
        } else {
            $error = "Usuario creado, pero falló el perfil. Intente nuevamente.";
        }
    } else {
        $error = "Error al crear el usuario.";
    }
}

// Si no es POST o hay error, mostrar formulario
include __DIR__ . '/../vista/registrarse/index.php';
?>
