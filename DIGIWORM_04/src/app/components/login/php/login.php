<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

require('conexion.php');
$con = retornarConexion();

// Obtener datos del método GET
$idusuarios = $_GET['idusuarios'] ?? null;
$contrasena = $_GET['Contrasena'] ?? null;

// Verificar si se proporcionaron los datos
if ($idusuarios !== null && $contrasena !== null) {
    $query = "SELECT idusuarios, Contrasena FROM usuarios WHERE idusuarios = '$idusuarios' AND Contrasena = '$contrasena'";
    
    // Ejecutar la consulta
    $result = mysqli_query($con, $query);

    if ($result) {
        // Verificar si hay resultados
        if (mysqli_num_rows($result) > 0) {
            // Obtener resultados como un array asociativo
            $vec = mysqli_fetch_assoc($result);

            // Enviar respuesta JSON
            echo json_encode(['success' => true, 'data' => $vec]);
        } else {
            // No hay resultados
            echo json_encode(['success' => false, 'error' => 'No se encontraron resultados']);
        }
    } else {
        // Error en la consulta
        echo json_encode(['success' => false, 'error' => 'Error en la consulta']);
    }
} else {
    // Datos no proporcionados
    echo json_encode(['success' => false, 'error' => 'Datos no proporcionados']);
}

// Cerrar la conexión
mysqli_close($con);

?>
