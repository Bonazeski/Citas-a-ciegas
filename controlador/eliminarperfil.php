<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /citasaciegas/controlador/iniciarsesion.php');
    exit();
}

require_once __DIR__ . '/../modelo/crud_perfil.php';

$idusuario = $_SESSION['usuario_id'];

if (eliminarperfilusuario($idusuario)) {
    // Si la eliminación fue exitosa, cerrar sesión
    session_unset();
    session_destroy();

    // Redirigir al inicio
    header('Location: /citasaciegas/vista/index.php');
    exit();
} else {
    // Si hubo un error, podrías mostrar una página o mensaje
    echo "<script>alert('Ocurrió un error al eliminar tu perfil. Inténtalo nuevamente.'); window.history.back();</script>";
}
?>