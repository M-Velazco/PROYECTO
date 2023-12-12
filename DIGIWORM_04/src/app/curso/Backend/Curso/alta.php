<?php
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("conexion.php");
$con = retornarConexion();

$result = new stdClass(); 

$idcurso = isset($params->idcurso) ? $params->idcurso : 0;

mysqli_query($con, "INSERT INTO curso(idcurso, nom_curso, estado) VALUES ($idcurso, '$params->nom_curso', '$params->estado')");

if (mysqli_affected_rows($con) > 0) {
    $result->resultado = 'OK';
    $result->mensaje = 'Datos grabados';
} else {
    $result->resultado = 'Error';
    $result->mensaje = 'No se pudieron grabar los datos';
}

header('Content-Type: application/json');
echo json_encode($result);
?>
