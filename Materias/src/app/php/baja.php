<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require("conexion.php");
$con = retornarConexion();

// Verificar si 'idmaterias' está presente en $_GET
$idmaterias = isset($_GET['idmaterias']) ? (int)$_GET['idmaterias'] : null;

if ($idmaterias !== null) {
    echo "ID a eliminar: " . $idmaterias; // Agrega esta línea para depurar
    mysqli_query($con, "delete from materias where idmaterias=$idmaterias");

    class Result {
    }

    $response = new Result();
    $response->resultado = 'OK';
    $response->mensaje = 'articulo borrado';

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si 'idmaterias' no está presente, devolver un mensaje de error
    echo json_encode(['error' => 'Parámetro idmaterias no proporcionado o no es un entero válido']);
}
