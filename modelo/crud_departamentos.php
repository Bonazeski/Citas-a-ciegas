<?php
require_once 'conexion.php';
//Obtiene los departamentos filtrados por una provincia específica.
function obtenerdepartamentos_por_provincia($idprovincia)
{
    // 1. Obtener la conexión a la base de datos
    $concexionbd = obtenerconexion();
    
    // 2. Construir la consulta SQL directamente
    $sql="SELECT iddepa, departamento FROM departamentos WHERE idprovincia = $idprovincia";

    // 3. Ejecutar la consulta
    $resultado = mysqli_query($concexionbd, $sql);
    
    $departamentos = []; // Inicializamos la variable

    if ($resultado) {
        // 4. Obtener todos los resultados como array asociativo
        $departamentos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        mysqli_free_result($resultado); // Liberamos recursos
    }
    
    // 5. Cerrar la conexión
    mysqli_close($concexionbd);
    
    return $departamentos; // Devolvemos el array de datos
}
function obtenerdepartamentodeperfil($iddepa)
{
    $concexionbd = obtenerconexion();   
    $sql="SELECT departamento FROM departamentos WHERE iddepa=$iddepa";

    $resultado=mysqli_query($concexionbd, $sql);
    // MYSQLI_ASSOC asegura que las claves del array sean los nombres de las columnas (iddepa, departamento)
    if ($resultado) {
        $departamento = mysqli_fetch_assoc($resultado);
        mysqli_free_result($resultado); // Libera la memoria del resultado
    } else {
        $departamento = null; // Si falla la consulta, devuelve null
    }
   
    mysqli_close($concexionbd);

    return $departamento;
}
function obtenerdepartamentos()
{
    // 1. Obtener la conexión a la base de datos
    $concexionbd = obtenerconexion();
    
    // 2. Construir la consulta SQL directamente
    $sql="SELECT * FROM departamentos";

    // 3. Ejecutar la consulta
    $resultado = mysqli_query($concexionbd, $sql);
    
    $departamentos = []; // Inicializamos la variable

    if ($resultado) {
        // 4. Obtener todos los resultados como array asociativo
        $departamentos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        mysqli_free_result($resultado); // Liberamos recursos
    }
    
    // 5. Cerrar la conexión
    mysqli_close($concexionbd);
    
    return $departamentos; // Devolvemos el array de datos
}
?>