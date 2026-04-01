<?php
session_start();

// Si el usuario NO está logueado, redirigir al login
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../vista/iniciarsesion/index.php');
    exit();
}

// Si el usuario está logueado, mostrar la vista
include __DIR__ . '/../vista/inicio/index.php';
