<?php
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("conexion.php");
$con = retornarConexion();

$idcurso = $params->idcurso;
$nom_curso = $params->nom_curso;
$estado = $params->estado;

$query = "UPDATE curso SET nom_curso='$nom_curso', estado='$estado' WHERE idcurso=$idcurso";
$result = mysqli_query($con, $query);

$response = new stdClass();

if ($result) {
    $response->resultado = 'OK';
    $response->mensaje = 'Datos modificados';
} else {
    $response->resultado = 'Error';
    $response->mensaje = 'No se pudieron modificar los datos';
    $response->error = mysqli_error($con);
}

header('Content-Type: application/json');
echo json_encode($response);
?>
