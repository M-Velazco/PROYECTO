<?php
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require("conexion.php");
$con = retornarConexion();

$idcurso = $_GET['idcurso'];

mysqli_query($con, "DELETE FROM curso WHERE idcurso = $idcurso");

$result = new stdClass(); 

if (mysqli_affected_rows($con) > 0) {
    $result->resultado = 'OK';
    $result->mensaje = 'Curso borrado';
} else {
    $result->resultado = 'Error';
    $result->mensaje = 'No se pudo borrar el curso';
}

header('Content-Type: application/json');
echo json_encode($result);
?>
