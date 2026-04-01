<?php
require_once 'conexion.php';

function obtenerestilosvida() {
    $conexion = obtenerconexion();
    $consulta = "SELECT * FROM estilosdevida";
    $resultado = $conexion->query($consulta);
    $estilosvida = [];
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $estilosvida[] = $fila;
        }
    }
    $conexion->close();
    return $estilosvida;
}

function obtenerestilodevidadeperfil($idusuario)
{
    $concexionbd = obtenerconexion();   
    $sql="SELECT estilo_de_vida, posible_respuesta, adj_sugeridos FROM estilosdevida WHERE id_estilo=(SELECT id_estilo FROM perfiles where idusuario= '$idusuario')";

    $resultado=mysqli_query($concexionbd, $sql);
    // MYSQLI_ASSOC asegura que las claves del array sean los nombres de las columnas (idestilodevida, estilo_de_vida)
    if ($resultado) {
        $estilodevida = mysqli_fetch_assoc($resultado);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $estilodevida = null; // Si falla la consulta, devuelve null
    }
   
    mysqli_close($concexionbd);

    return $estilodevida;
}
?>