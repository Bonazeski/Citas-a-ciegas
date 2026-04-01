<?php
require_once 'conexion.php';
function insertperfil($nombre, $apellido, $nacimiento, $provincia_selector, $departamento_selector, $idusuario, $sexo, $genero, $orientacionsexual, $descripcion)
{
    $concexionbd = obtenerconexion();

    // La consulta se mantiene simple, usando las variables escapadas
    $sql="INSERT INTO perfiles(nombre, apellido, fecha_nac, idprovincia, iddepa, idusuario, idsexo, idgenero, idorientacion, libredescripcion) 
        VALUES ('$nombre','$apellido','$nacimiento','$provincia_selector','$departamento_selector', '$idusuario','$sexo','$genero','$orientacionsexual','$descripcion')";
    
    $resultado =mysqli_query($concexionbd, $sql);
    mysqli_close($concexionbd);

    return $resultado; // Devuelve TRUE o FALSE
}
function obtenerperfilporidusuario($idusuario)
{
    $concexionbd = obtenerconexion();

    $sql = "SELECT * FROM perfiles WHERE idusuario = '$idusuario'";
    $resultado = mysqli_query($concexionbd, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $perfil = mysqli_fetch_assoc($resultado);
        return $perfil;
    } else {
        return null; // No se encontró el perfil
    }
}
function editarperfilusuario($idusuario, $provincia_selector, $departamento_selector, $sexo, $genero, $orientacionsexual,$tiempolibre, $citaideal,$relacionespersonales, $estilodevida,$motivaciondeldia, $descripcion)
{
    $concexionbd = obtenerconexion();
    // Campos opcionales: si vienen vacíos, se transforman en NULL
    $tiempolibre = !empty($tiempolibre) ? "'$tiempolibre'" : "NULL";
    $citaideal = !empty($citaideal) ? "'$citaideal'" : "NULL";
    $relacionespersonales = !empty($relacionespersonales) ? "'$relacionespersonales'" : "NULL";
    $estilodevida = !empty($estilodevida) ? "'$estilodevida'" : "NULL";
    $motivaciondeldia = !empty($motivaciondeldia) ? "'$motivaciondeldia'" : "NULL";

    $sql = "UPDATE perfiles 
            SET  
                idprovincia = '$provincia_selector', 
                iddepa = '$departamento_selector', 
                idsexo = '$sexo', 
                idgenero = '$genero', 
                idorientacion = '$orientacionsexual', 
                id_tiempo_libre = $tiempolibre,
                id_cita_ideal = $citaideal,
                id_relacion = $relacionespersonales,
                id_estilo = $estilodevida,
                id_motivacion = $motivaciondeldia,
                libredescripcion = '$descripcion' 
            WHERE idusuario = '$idusuario'";

    $resultado = mysqli_query($concexionbd, $sql);
    mysqli_close($concexionbd);

    return $resultado; // Devuelve TRUE o FALSE
}
function eliminarperfilusuario($idusuario)
{
    $conexionbd = obtenerconexion();

    $sql1 = "DELETE FROM perfiles WHERE idusuario = '$idusuario'";
    $sql2 = "DELETE FROM usuarios WHERE idusuario = '$idusuario'";

    $resultado1 = mysqli_query($conexionbd, $sql1);
    $resultado2 = mysqli_query($conexionbd, $sql2);

    if ($resultado1 && $resultado2) {
        
        $resultado = true;
    } else {
        
        $resultado = false;
    }
    mysqli_close($conexionbd);

    return $resultado; // Devuelve TRUE o FALSE
}
function obtenerperfilesfiltrados($filtros = [], $idperfil) {
    $conexionbd = obtenerconexion();
    if (is_array($idperfil) && isset($idperfil['idperfil'])) {
        $id_a_excluir = $idperfil['idperfil'];
    } else {
        // Si no es un array o la clave no es 'idperfil', asumimos que ya es el ID.
        $id_a_excluir = $idperfil;
    }

    $idperfil_seguro = mysqli_real_escape_string($conexionbd, $id_a_excluir);
    $sql = "SELECT 
                perfiles.idperfil,
                perfiles.nombre,
                perfiles.apellido,
                perfiles.fecha_nac,
                perfiles.idusuario,
                sexos.sex,
                generos.genero,
                orientacionessexuales.orientacionsexual,
                provincias.provincia,
                departamentos.departamento,
                tiempolibre.actividad,
                citaideal.cita_ideal,
                relacionespersonales.descripcion_relacion,
                estilosdevida.estilo_de_vida,
                motivacionesdeldia.motivacion_del_dia,
                perfiles.libredescripcion
            FROM perfiles
            LEFT JOIN sexos ON perfiles.idsexo = sexos.idsexo
            LEFT JOIN generos ON perfiles.idgenero = generos.idgenero
            LEFT JOIN orientacionessexuales ON perfiles.idorientacion = orientacionessexuales.idorientacion
            LEFT JOIN provincias ON perfiles.idprovincia = provincias.idprovincia
            LEFT JOIN departamentos ON perfiles.iddepa = departamentos.iddepa
            LEFT JOIN tiempolibre ON perfiles.id_tiempo_libre = tiempolibre.id_tiempo_libre
            LEFT JOIN citaideal ON perfiles.id_cita_ideal = citaideal.id_cita_ideal
            LEFT JOIN relacionespersonales ON perfiles.id_relacion = relacionespersonales.id_relacion
            LEFT JOIN estilosdevida ON perfiles.id_estilo = estilosdevida.id_estilo
            LEFT JOIN motivacionesdeldia ON perfiles.id_motivacion = motivacionesdeldia.id_motivacion
            WHERE perfiles.idperfil != '$idperfil_seguro'";

    // 🔹 Filtros opcionales
    if (!empty($filtros['provincia'])) {
        $provincia = mysqli_real_escape_string($conexionbd, $filtros['provincia']);
        $sql .= " AND perfiles.idprovincia = '$provincia'";
    }
    if (!empty($filtros['departamento'])) {
        $departamento = mysqli_real_escape_string($conexionbd, $filtros['departamento']);
        $sql .= " AND perfiles.iddepa = '$departamento'";
    }
    if (!empty($filtros['sexo'])) {
        $sexo = mysqli_real_escape_string($conexionbd, $filtros['sexo']);
        $sql .= " AND perfiles.idsexo = '$sexo'";
    }
    if (!empty($filtros['genero'])) {
        $genero = mysqli_real_escape_string($conexionbd, $filtros['genero']);
        $sql .= " AND perfiles.idgenero = '$genero'";
    }
    if (!empty($filtros['orientacion'])) {
        $orientacion = mysqli_real_escape_string($conexionbd, $filtros['orientacion']);
        $sql .= " AND perfiles.idorientacion = '$orientacion'";
    }
    if (!empty($filtros['tiempoLibre'])) {
        $tiempoLibre = mysqli_real_escape_string($conexionbd, $filtros['tiempoLibre']);
        $sql .= " AND perfiles.id_tiempo_libre = '$tiempoLibre'";
    }
    if (!empty($filtros['citaIdeal'])) {
        $citaIdeal = mysqli_real_escape_string($conexionbd, $filtros['citaIdeal']);
        $sql .= " AND perfiles.id_cita_ideal = '$citaIdeal'";
    }
    if (!empty($filtros['relacion'])) {
        $relacion = mysqli_real_escape_string($conexionbd, $filtros['relacion']);
        $sql .= " AND perfiles.id_relacion = '$relacion'";
    }
    if (!empty($filtros['estilo'])) {
        $estilo = mysqli_real_escape_string($conexionbd, $filtros['estilo']);
        $sql .= " AND perfiles.id_estilo = '$estilo'";
    }
    if (!empty($filtros['motivacion'])) {
        $motivacion = mysqli_real_escape_string($conexionbd, $filtros['motivacion']);
        $sql .= " AND perfiles.id_motivacion = '$motivacion'";
    }

    $resultado = mysqli_query($conexionbd, $sql);
    $perfiles = [];
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $perfiles[] = $fila;
        }
    }

    mysqli_close($conexionbd);
    return $perfiles;
}
function obteneridperfil($idusuario)
{
    $conexionbd = obtenerconexion();
    $sql = "SELECT idperfil FROM perfiles WHERE idusuario = $idusuario";

    $resultado = mysqli_query($conexionbd, $sql);

    $ideprfil = mysqli_fetch_assoc($resultado);

    return $ideprfil;
}
?>