<?php
//defino constantes para que puedan ser usadas de manera global, asi puedo utilizarlas en las funciones
define('SERVER', '127.0.0.1');    // Dirección del servidor de la base de datos
define('USER', 'root');          // Nombre de usuario para acceder a la base de datos
define('PASS', '');                // Contraseña
define('DATABASE', 'citasaciegas'); // Nombre de la base de datos
define('PORT', '3306');             // Puerto por donde MySQL escucha 
function obtenerconexion ()
{
    $conn= mysqli_connect(SERVER, USER, PASS, DATABASE, PORT);
    if ($conn->connect_error) {
        die("error al conectarse a la base de datos. ".$conn->connect_error);
    }
    return $conn;
}
?>