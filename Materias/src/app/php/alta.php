<?php 
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("conexion.php");
$con = retornarConexion();

// Escapar y validar los datos
$idmaterias = mysqli_real_escape_string($con, $params->idmaterias);
$nom_materia = mysqli_real_escape_string($con, $params->nom_materia);

$query = "INSERT INTO materias (idmaterias, nom_materia) VALUES ($idmaterias, '$nom_materia')";

// Ejecutar la consulta
$resultado = mysqli_query($con, $query);

class Result {}

$response = new Result();

if ($resultado) {
    $response->resultado = 'OK';
    $response->mensaje = 'datos grabados';
} else {
    $response->resultado = 'Error';
    $response->mensaje = 'Error al grabar datos: ' . mysqli_error($con);
}

header('Content-Type: application/json');
echo json_encode($response);
?>
