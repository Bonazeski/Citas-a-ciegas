<?php
require_once 'conexion.php';
function insertuser($nombre_usuario, $email, $contraseña)
{
    // PASO 1: SEGURIDAD DE LA CONTRASEÑA
    $contraseña_encriptada = password_hash($contraseña, PASSWORD_DEFAULT);
    
    $concexionbd = obtenerconexion();    

    // PASO 2: Ejecutar la Inserción
    $sql="INSERT INTO usuarios(user, password, email) 
        VALUES ('$nombre_usuario','$contraseña_encriptada','$email')";
        
    $resultado = mysqli_query($concexionbd, $sql);
    
    if ($resultado) {
        // La consulta fue exitosa.
        
        // Obtiene el ID que MySQL asignó automáticamente al nuevo usuario.
        $id_generado = mysqli_insert_id($concexionbd);
        
        mysqli_close($concexionbd);
        return $id_generado; // Devuelve el ID (un número entero)
        
    } else {
        // La consulta SQL falló.
        
        mysqli_close($concexionbd);
        return false; // Devuelve FALSE
    }
}
function obtenernombresusuarios(){
    $concexionbd = obtenerconexion();    

    $sql="SELECT user FROM usuarios";
        
    $resultado = mysqli_query($concexionbd, $sql);
    
    $usuarios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    
    mysqli_close($concexionbd);
    return $usuarios; // Devuelve un array con todos los nombres de usuarios
}
function obtenerdatosusuario($usuario) {
    $concexionbd = obtenerconexion();

    // Escapar el nombre de usuario para evitar errores y SQL injection
    $usuario = mysqli_real_escape_string($concexionbd, $usuario);

    $sql = "SELECT * FROM usuarios WHERE user = '$usuario'";
    $resultado = mysqli_query($concexionbd, $sql);

    if (!$resultado) {
        // Muestra el error de SQL en desarrollo (puedes quitarlo luego)
        die("Error en la consulta SQL: " . mysqli_error($concexionbd));
    }

    $fila = mysqli_fetch_assoc($resultado);
    mysqli_close($concexionbd);
    return $fila; // devuelve una sola fila o null si no hay coincidencias
}
function editarusuario($idusuario, $nombreuser, $email, $pass) {
    $concexionbd = obtenerconexion();

    // PASO 1: SEGURIDAD DE LA CONTRASEÑA
    $contraseña_encriptada = password_hash($pass, PASSWORD_DEFAULT);

    // PASO 2: Ejecutar la Actualización
    $sql = "UPDATE usuarios 
            SET user = '$nombreuser', email = '$email', password = '$contraseña_encriptada' 
            WHERE idusuario = $idusuario";

    $resultado = mysqli_query($concexionbd, $sql);

    if ($resultado) {
        // La consulta fue exitosa.
        mysqli_close($concexionbd);
        return true; // Devuelve TRUE
    } else {
        // La consulta SQL falló.
        mysqli_close($concexionbd);
        return false; // Devuelve FALSE
    }
}
?>
