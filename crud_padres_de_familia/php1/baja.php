<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require("conexion.php");
$con = retornarConexion();

// Verificar la existencia del parámetro 'codigo'
$codigo = isset($_GET['codigo']) ? intval($_GET['codigo']) : 0;

if ($codigo === 0) {
    echo json_encode(['resultado' => 'Error', 'mensaje' => 'Parámetro "codigo" no válido']);
    exit;
}

// Utilizar una consulta preparada para evitar la inyección SQL
$query = "DELETE FROM articulos WHERE codigo = ?";
$stmt = mysqli_prepare($con, $query);

if ($stmt === false) {
    echo json_encode(['resultado' => 'Error', 'mensaje' => 'Error en la preparación de la consulta']);
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $codigo);

if (mysqli_stmt_execute($stmt) === false) {
    echo json_encode(['resultado' => 'Error', 'mensaje' => 'Error en la ejecución de la consulta']);
    exit;
}

mysqli_stmt_close($stmt);

class Result {}

$response = new Result();
$response->resultado = 'OK';
$response->mensaje = 'Artículo borrado';

header('Content-Type: application/json');
echo json_encode($response);
?>


