<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /citasaciegas/controlador/iniciarsesion.php');
    exit();
}

// Ruta correcta desde la carpeta /controlador hacia la vista
include __DIR__ . '/../vista/inicio/devoluciones/index.php';
?>
