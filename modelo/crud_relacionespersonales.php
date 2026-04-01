<?php
require_once 'conexion.php';
function obtenerrelacionespersonales()
{
    $concexionbd = obtenerconexion();   
    $sql="SELECT * FROM relacionespersonales";

    $resultado=mysqli_query($concexionbd, $sql);
    // MYSQLI_ASSOC asegura que las claves del array sean los nombres de las columnas (idrelacionpersonal, relacionpersonal)
    if ($resultado) {
        $relaciones_personales = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $relaciones_personales = []; // Si falla la consulta, devuelve un array vacío
    }
   
    mysqli_close($concexionbd);

    return $relaciones_personales;    
}
function obtenerrelacionespersonalesdeperfil($idusuario){

    $concexionbd = obtenerconexion();   
    $sql="SELECT descripcion_relacion, posible_respuesta, adj_sugeridos FROM relacionespersonales where id_relacion = (SELECT id_relacion FROM perfiles where idusuario= '$idusuario')";
    $resultado=mysqli_query($concexionbd, $sql);
    if ($resultado) {
        $relacionpersonalperfil = mysqli_fetch_assoc($resultado);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $relacionpersonalperfil = null; // Si falla la consulta, devuelve null
    }
    mysqli_close($concexionbd);
    return $relacionpersonalperfil;
}
?>