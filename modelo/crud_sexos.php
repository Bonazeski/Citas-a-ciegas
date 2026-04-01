<?php
require_once 'conexion.php';
//para esta primera instancia solo buscamos traer los datos de la tabla sexos

function obtenersexos()
{
    $concexionbd = obtenerconexion();   
    $sql="SELECT * FROM sexos";

    $resultado=mysqli_query($concexionbd, $sql);
    // MYSQLI_ASSOC asegura que las claves del array sean los nombres de las columnas (idsexo, sex)
    if ($resultado) {
        $sexos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $sexos = []; // Si falla la consulta, devuelve un array vacío
    }
   
    mysqli_close($concexionbd);

    return $sexos;
}
function obtenersexodeperfil($idusuario){

    $concexionbd = obtenerconexion();   
    $sql="SELECT sex FROM sexos where idsexo = (SELECT idsexo FROM perfiles where idusuario= '$idusuario')";
    $resultado=mysqli_query($concexionbd, $sql);
    if ($resultado) {
        $sexoperfil = mysqli_fetch_assoc($resultado);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $sexoperfil = null; // Si falla la consulta, devuelve null
    }
    mysqli_close($concexionbd);
    return $sexoperfil;
}
?>