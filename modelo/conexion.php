<?php

require_once __DIR__ . '/../config/bootstrap.php';

// Defino constantes globales a partir del .env
define('SERVER', $_ENV['DB_HOST']);
define('USER', $_ENV['DB_USER']);
define('PASS', $_ENV['DB_PASS']);
define('DATABASE', $_ENV['DB_NAME']);
define('PORT', $_ENV['DB_PORT']);

function obtenerconexion()
{
    $conn = mysqli_connect(SERVER, USER, PASS, DATABASE, PORT);

    if (!$conn) {
        die("Error al conectarse a la base de datos: " . mysqli_connect_error());
    }

    return $conn;
}
?>