<?php
require_once 'conexion.php';
function obtenermotivacionesdeldia()
{
    $concexionbd = obtenerconexion();   
    $sql="SELECT * FROM motivacionesdeldia";

    $resultado=mysqli_query($concexionbd, $sql);
    // MYSQLI_ASSOC asegura que las claves del array sean los nombres de las columnas (idmotivacion, motivacion)
    if ($resultado) {
        $motivaciones = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $motivaciones = []; // Si falla la consulta, devuelve un array vacío
    }
   
    mysqli_close($concexionbd);

    return $motivaciones;
}
function obtenermotivaciondeldiadeperfil($idusuario){

    $concexionbd = obtenerconexion();   
    $sql="SELECT motivacion_del_dia, posible_respuesta, adj_sugeridos FROM motivacionesdeldia where id_motivacion = (SELECT id_motivacion FROM perfiles where idusuario= '$idusuario')";
    $resultado=mysqli_query($concexionbd, $sql);
    if ($resultado) {
        $motivacionperfil = mysqli_fetch_assoc($resultado);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $motivacionperfil = null; // Si falla la consulta, devuelve null
    }
    mysqli_close($concexionbd);
    return $motivacionperfil;
}
?>