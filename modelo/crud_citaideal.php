<?php
require_once 'conexion.php';

function obtenercitaideal()
{
    $concexionbd = obtenerconexion();   
    $sql="SELECT * FROM citaideal";

    $resultado=mysqli_query($concexionbd, $sql);
    // MYSQLI_ASSOC asegura que las claves del array sean los nombres de las columnas (idcitaideal, citaideal)
    if ($resultado) {
        $citas_ideales = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $citas_ideales = []; // Si falla la consulta, devuelve un array vacío
    }
   
    mysqli_close($concexionbd);

    return $citas_ideales;
}
function obtenercitaidealdeperfil($idusuario){

    $concexionbd = obtenerconexion();   
    $sql="SELECT cita_ideal, posible_respuesta, adj_sugeridos FROM citaideal where id_cita_ideal = (SELECT id_cita_ideal FROM perfiles where idusuario= '$idusuario')";

    $resultado=mysqli_query($concexionbd, $sql);
    if ($resultado) {
        $citaidealperfil = mysqli_fetch_assoc($resultado);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $citaidealperfil = null; // Si falla la consulta, devuelve null
    }
    mysqli_close($concexionbd);
    return $citaidealperfil;
}
?>