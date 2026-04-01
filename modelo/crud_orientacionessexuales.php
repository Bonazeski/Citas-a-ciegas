<?php
require_once 'conexion.php';
//para esta primera instancia solo buscamos traer los datos de la tabla orientacionessexuales
function obtenerorientacionessexuales()
{
    $concexionbd = obtenerconexion();   
    $sql="SELECT * FROM orientacionessexuales";

    $resultado=mysqli_query($concexionbd, $sql);
    // MYSQLI_ASSOC asegura que las claves del array sean los nombres de las columnas (idorientacion, orientacionsexual, descripcion)
    if ($resultado) {
        $orientacionessexuales = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $orientacionessexuales = []; // Si falla la consulta, devuelve un array vacío
    }
   
    mysqli_close($concexionbd);

    return $orientacionessexuales;
}
function obtenerorientacionsexualdeperfil($idusuario){

    $concexionbd = obtenerconexion();   
    $sql="SELECT orientacionsexual FROM orientacionessexuales where idorientacion = (SELECT idorientacion FROM perfiles where idusuario= '$idusuario')";
    $resultado=mysqli_query($concexionbd, $sql);
    if ($resultado) {
        $orientacionsexualperfil = mysqli_fetch_assoc($resultado);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $orientacionsexualperfil = null; // Si falla la consulta, devuelve null
    }
    mysqli_close($concexionbd);
    return $orientacionsexualperfil;
}
?>