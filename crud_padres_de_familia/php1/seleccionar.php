<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Content-Type: application/json');

require("conexion.php");
$con = retornarConexion();

// Sanitiza y valida el valor del parámetro $_GET['codigo']
$codigo = isset($_GET['codigo']) ? intval($_GET['codigo']) : 0;

if ($codigo <= 0) {
    // Manejar el error, por ejemplo, devolver un mensaje de error o salir del script
    $errorResponse = ['error' => 'Código no válido'];
    echo json_encode($errorResponse);
    exit;
}

// Utiliza una consulta preparada para evitar la inyección SQL
$consulta = "SELECT codigo, idpadre_de_familia, precio FROM articulos WHERE codigo = ?";
$stmt = mysqli_prepare($con, $consulta);

if (!$stmt) {
    // Manejar el error en la preparación de la consulta
    $errorResponse = ['error' => 'Error en la preparación de la consulta'];
    echo json_encode($errorResponse);
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $codigo);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

$vec = array();

while ($reg = mysqli_fetch_assoc($resultado)) {
    $vec[] = $reg;
}

echo json_encode($vec);

// Cierra la conexión y libera los recursos
mysqli_stmt_close($stmt);
mysqli_close($con);
?>

