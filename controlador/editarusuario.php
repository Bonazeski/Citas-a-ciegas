<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /citasaciegas/controlador/iniciarsesion.php');
    exit();
}

require_once __DIR__ . '/../modelo/crud_usuario.php';

$nombreUsuarioSesion = $_SESSION['usuario_nombre'];
$idusuario = $_SESSION['usuario_id'];
$usuario = obtenerdatosusuario($nombreUsuarioSesion);

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombreuser = isset($_POST['nombreuser']) ? trim($_POST['nombreuser']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $pass = isset($_POST['pass']) ? trim($_POST['pass']) : '';
    $pass2 = isset($_POST['pass2']) ? trim($_POST['pass2']) : '';

    if (empty($nombreuser) || empty($email) || empty($pass) || empty($pass2)) {
        $error = "Por favor, complete todos los campos obligatorios.";
    } elseif ($pass !== $pass2) {
        $error = "Las contraseñas no coinciden.";
    } elseif (strlen($pass) < 8) {
        $error = "La contraseña debe tener al menos 8 caracteres.";
    } else {
        $usuarioeditado = editarusuario(
            $idusuario,
            $nombreuser,
            $email,
            $pass
        );

        if ($usuarioeditado) {
            header('Location: /citasaciegas/controlador/miperfil.php');
            exit();
        } else {
            $error = "No se pudo actualizar el usuario. Intente nuevamente.";
        }
    }
}

include __DIR__ . '/../vista/inicio/miperfil/editarusuario/index.php';
?>
