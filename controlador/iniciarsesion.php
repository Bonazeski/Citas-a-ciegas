<?php
session_start();
include '../modelo/crud_usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = isset($_POST['user']) ? trim($_POST['user']) : '';
    $pass = isset($_POST['pass']) ? trim($_POST['pass']) : '';

    if (empty($user) || empty($pass)) {
        $error = "Por favor, complete todos los campos.";
        include __DIR__ . '/../vista/iniciarsesion/index.php';
        exit();
    }

    $datos_usuario = obtenerdatosusuario($user);

    // Verificar credenciales
    if ($datos_usuario && isset($datos_usuario['password']) && password_verify($pass, $datos_usuario['password'])) {
        
        $_SESSION['usuario_id'] = $datos_usuario['idusuario'];
        $_SESSION['usuario_nombre'] = $datos_usuario['user'];

    
        header('Location: /citasaciegas/vista/inicio/index.php');
        exit();
        
    } else {
    $error = "Acceso inválido";
    
    include __DIR__ . '/../vista/iniciarsesion/index.php';
    exit();
    }

}
include __DIR__ . '/../vista/iniciarsesion/index.php';
?>
