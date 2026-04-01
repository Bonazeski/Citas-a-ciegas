<?php
require_once 'conexion.php';
//para esta primera instancia solo buscamos traer los datos de la tabla generos
function obtenergeneros()
{
    $concexionbd = obtenerconexion();   
    $sql="SELECT * FROM generos";

    $resultado=mysqli_query($concexionbd, $sql);
    // MYSQLI_ASSOC asegura que las claves del array sean los nombres de las columnas (idgenero, genero)
    if ($resultado) {
        $generos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $generos = []; // Si falla la consulta, devuelve un array vacío
    }
   
    mysqli_close($concexionbd);

    return $generos;
}
function obtenergenerodeperfil($idusuario){

    $concexionbd = obtenerconexion();   
    $sql="SELECT genero FROM generos where idgenero = (SELECT idgenero FROM perfiles where idusuario= '$idusuario')";
    $resultado=mysqli_query($concexionbd, $sql);
    if ($resultado) {
        $generoperfil = mysqli_fetch_assoc($resultado);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $generoperfil = null; // Si falla la consulta, devuelve null
    }
    mysqli_close($concexionbd);
    return $generoperfil;
}
?>