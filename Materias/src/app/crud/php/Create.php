<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  header('Content-Type: application/json');
  
  $json = file_get_contents('php://input');
 
  $params = json_decode($json);
  
  require("Conexion.php");
  $con=retornarConexion();
  

  mysqli_query($con,"insert into materias(idmaterias,nom_materia) values
                  ('$params->ID',$params->Name)");
    
  
  class Result {}

  $response = new Result();
  $response->resultado = 'OK';
  $response->mensaje = 'datos grabados';

  header('Content-Type: application/json');
  echo json_encode($response);  
?>