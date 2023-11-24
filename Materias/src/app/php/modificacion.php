<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  $json = file_get_contents('php://input');
  $params = json_decode($json);
  
  require("conexion.php");
  $con = retornarConexion();

  // Utiliza mysqli_real_escape_string para escapar el valor de nom_materia
  $nom_materia = mysqli_real_escape_string($con, $params->nom_materia);

  // Actualiza la consulta SQL utilizando comillas para el valor de nom_materia
  mysqli_query($con, "update materias set nom_materia='$nom_materia' where idmaterias=$params->idmaterias");

  class Result {}

  $response = new Result();
  $response->resultado = 'OK';
  $response->mensaje = 'datos modificados';

  header('Content-Type: application/json');
  echo json_encode($response);  
?>
