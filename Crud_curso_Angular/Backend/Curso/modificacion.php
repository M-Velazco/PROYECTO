<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  $json = file_get_contents('php://input');
 
  $params = json_decode($json);
  
  require("conexion.php");
  $con = retornarConexion();
  
  mysqli_query($con, "update curso set nom_curso='$params->nom_curso', estado='$params->estado' where idcurso=$params->idcurso");
    
  $response = new stdClass();
  $response->resultado = 'OK';
  $response->mensaje = 'datos modificados';

  header('Content-Type: application/json');
  echo json_encode($response);  
?>
