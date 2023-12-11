<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

require('conexion.php');
$con = retornarConexion();

// Verificar si se reciben los datos
$idusuarios = isset($_GET['Idusuarios']) ? $_GET['Idusuarios'] : null;
$contrasena = isset($_GET['Contrasena']) ? $_GET['Contrasena'] : null;

if ($idusuarios !== null && $contrasena !== null) {
    // Utilizar parámetros en la consulta SQL para evitar inyecciones SQL
    $stmt = mysqli_prepare($con, 'SELECT * FROM usuarios WHERE Idusuarios = ? AND Contraseña = ?');
    mysqli_stmt_bind_param($stmt, 'is', $idusuarios, $contrasena);
    mysqli_stmt_execute($stmt);

    // Verificar si la consulta fue exitosa
    if ($stmt) {
        // Obtener resultados
        $result = mysqli_stmt_get_result($stmt);

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

        // Liberar recursos
        mysqli_stmt_close($stmt);
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
