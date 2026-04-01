<?php
include_once 'conexion.php';

function insertarcita($idusuario_solicitante, $idusuario_receptor, $fecha, $hora, $latitud_encuentro, $longitud_encuentro, $placename, $placeadress, $place_id,$detalle, $estadocita)
{   
    $concexionbd = obtenerconexion();
    $sql="INSERT INTO citas (perfil1, perfil2,  fecha, hora,latitud, longitud, place_name, place_address, place_id,detalle, estadocita, propuesta_por) 
          VALUES ('$idusuario_solicitante','$idusuario_receptor','$fecha','$hora','$latitud_encuentro','$longitud_encuentro','$placename', '$placeadress', '$place_id', '$detalle','$estadocita', '$idusuario_solicitante')";
    $resultado = mysqli_query($concexionbd, $sql);
    mysqli_close($concexionbd);
    return $resultado;
}

function obtenercitasusuario($idusuario)
{
    $con = obtenerconexion();

    $sql = "
        SELECT 
            c.id_cita,
            c.perfil1,
            c.perfil2,
            c.fecha,
            c.hora,
            c.latitud,
            c.longitud,
            c.place_name,
            c.place_address,
            c.place_id,
            c.detalle,
            c.devolucion,
            c.estadocita,
            c.propuesta_por,

            p1.nombre AS nombre_solicitante,
            p1.apellido AS apellido_solicitante,

            p2.nombre AS nombre_receptor,
            p2.apellido AS apellido_receptor

        FROM citas c
        INNER JOIN perfiles p1 ON c.perfil1 = p1.idusuario
        INNER JOIN perfiles p2 ON c.perfil2 = p2.idusuario
        WHERE c.perfil1 = '$idusuario' 
        OR c.perfil2 = '$idusuario'
        ORDER BY c.fecha DESC, c.hora DESC
    ";


    $res = mysqli_query($con, $sql);
    $lista = [];

    if ($res) {
        while ($fila = mysqli_fetch_assoc($res)) {
            $lista[] = $fila;
        }
    }

    mysqli_close($con);
    return $lista;
}
function cambiarEstadoCita($idcita, $nuevoEstado, $quienPropuso = null)
{
    $concexionbd = obtenerconexion();

    if ($quienPropuso === null) {
        // Solo cambia el estado (aceptar, rechazar, etc.)
        $sql = "UPDATE citas SET estadocita = '$nuevoEstado' WHERE id_cita = '$idcita'";
    } else {
        // Cambia estado y actualiza quien hizo la propuesta
        $sql = "UPDATE citas 
                SET estadocita = '$nuevoEstado',
                    propuesta_por = '$quienPropuso'
                WHERE id_cita = '$idcita'";
    }

    $resultado = mysqli_query($concexionbd, $sql);

    mysqli_close($concexionbd);

    return $resultado;
}

?>
