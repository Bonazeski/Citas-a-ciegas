<?php
require_once 'conexion.php';
function obtenertiempolibre()
{
    $concexionbd = obtenerconexion();   
    $sql="SELECT * FROM tiempolibre";

    $resultado=mysqli_query($concexionbd, $sql);
    // MYSQLI_ASSOC asegura que las claves del array sean los nombres de las columnas (idtiempolibre, tiempolibre)
    if ($resultado) {
        $tiempos_libres = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $tiempos_libres = []; // Si falla la consulta, devuelve un array vacío
    }
   
    mysqli_close($concexionbd);

    return $tiempos_libres;
}

function obtenertiempolibredeperfil($idusuario){

    $concexionbd = obtenerconexion();   
    $sql="SELECT actividad, posible_respuesta, adj_sugeridos FROM tiempolibre where id_tiempo_libre = (SELECT id_tiempo_libre FROM perfiles where idusuario= '$idusuario')";
    $resultado=mysqli_query($concexionbd, $sql);
    if ($resultado) {
        $tiempolibreperfil = mysqli_fetch_assoc($resultado);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $tiempolibreperfil = null; // Si falla la consulta, devuelve null
    }
    mysqli_close($concexionbd);
    return $tiempolibreperfil;
}


?>