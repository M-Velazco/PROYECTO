<?php 
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("conexion.php");
$con = retornarConexion();

mysqli_query($con, "INSERT INTO articulos (idpadre_de_familia, estado_matr, nombre_padre) VALUES ('$params->idpadre_de_familia', $params->estado_matr, '$params->nombre_padre')");

class Result {}

$response = new Result();
$response->resultado = 'OK';
$response->mensaje = 'datos grabados';

header('Content-Type: application/json');
echo json_encode($response);  
?>


  