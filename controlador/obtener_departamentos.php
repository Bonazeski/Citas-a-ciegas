<?php
// Este archivo NO genera ninguna página HTML. Solo devuelve datos JSON.

// 1. Incluimos el Modelo (archivo que tiene la función para consultar la BD).
// Asegúrese de que la ruta relativa sea correcta para su estructura de carpetas.
require_once '../modelo/crud_departamentos.php';

// 2. OBTENER EL ID ENVIADO POR JAVASCRIPT
// Capturamos la variable 'id_provincia' que viene en la URL.
// Usamos '?? 0' para asegurar que siempre haya un valor (0) si el ID no se envía, evitando errores.
$id_provincia = $_GET['id_provincia'] ?? 0;

// 3. OBTENER LOS DATOS DEL MODELO
// Llamamos a la función que consulta la base de datos con el ID filtrado.
$departamentos = obtenerdepartamentos_por_provincia($id_provincia);

// 4. PREPARAR Y ENVIAR LA RESPUESTA JSON
// Indicamos al navegador que lo que sigue es JSON (es crucial para el JavaScript).
header('Content-Type: application/json');

// Convertimos el array de PHP ($departamentos) a una cadena de texto JSON
// y la imprimimos (enviamos) al JavaScript.
echo json_encode($departamentos);

// 5. DETENER LA EJECUCIÓN
// Aseguramos que no se imprima nada más (ni espacios ni saltos de línea) después del JSON.
exit();
?>