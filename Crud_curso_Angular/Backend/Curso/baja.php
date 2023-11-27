<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  require("conexion.php");
  $con = retornarConexion();
  
  mysqli_query($con, "delete from curso where idcurso=$_GET[idcurso]");
    
  $response = new stdClass();
  $response->resultado = 'OK';
  $response->mensaje = 'curso borrado';

  header('Content-Type: application/json');
  echo json_encode($response);  
?>
