<?php 
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("conexion.php");
$con = retornarConexion();

mysqli_query($con, "INSERT INTO padre_de_familia (idpadre_de_familia, est_rep, estado_matr) VALUES ('$params->idpadre_de_familia','$params->est_rep', $params->estado_matr)");

class Result {}

$response = new Result();
$response->resultado = 'OK';
$response->mensaje = 'datos grabados';

header('Content-Type: application/json');
echo json_encode($response);  
?>


  