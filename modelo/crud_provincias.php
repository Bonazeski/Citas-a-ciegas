<?php
require_once 'conexion.php';
//para esta primera instancia solo buscamos traer los datos de la tabla provincias
function obtenerprovincias()
{
    $concexionbd = obtenerconexion();   
    $sql="SELECT * FROM provincias";

    $resultado=mysqli_query($concexionbd, $sql);
    // MYSQLI_ASSOC asegura que las claves del array sean los nombres de las columnas (idprovincia, provincia)
    if ($resultado) {
        $provincias = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $provincias = []; // Si falla la consulta, devuelve un array vacío
    }
   
    mysqli_close($concexionbd);

    return $provincias;
}
function obtenerprovinciadeperfil($idprovincia)
{
    $concexionbd = obtenerconexion();   
    $sql="SELECT provincia FROM provincias WHERE idprovincia=$idprovincia";

    $resultado=mysqli_query($concexionbd, $sql);
    // MYSQLI_ASSOC asegura que las claves del array sean los nombres de las columnas (idprovincia, provincia)
    if ($resultado) {
        $provincia = mysqli_fetch_assoc($resultado);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $provincia = null; // Si falla la consulta, devuelve null
    }
   
    mysqli_close($concexionbd);

    return $provincia;
}