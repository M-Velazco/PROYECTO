<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  $json = file_get_contents('php://input');
  $params = json_decode($json);
  
  require("conexion.php");
  $con = retornarConexion();

  // Utiliza mysqli_real_escape_string para escapar los valores
  $nom_materia = mysqli_real_escape_string($con, $params->nom_materia);
  $Correo = mysqli_real_escape_string($con, $params->Correo);
  $Curso_pr = mysqli_real_escape_string($con, $params->Curso_pr);
  $Materia = mysqli_real_escape_string($con, $params->Materia);

  // Hash de la nueva contraseña
  $hashedContrasena = password_hash($params->Contrasena, PASSWORD_DEFAULT);

  // Actualiza la consulta SQL utilizando comillas y el hash para el valor de Contrasena
  mysqli_query($con, "UPDATE docente SET Nombre_apellido='$nom_materia', Correo='$Correo', Contrasena='$hashedContrasena', Curso_pr='$Curso_pr', Materia='$Materia' WHERE iddocente=$params->iddocente");

  class Result {}

  $response = new Result();
  $response->resultado = 'OK';
  $response->mensaje = 'datos modificados';

  header('Content-Type: application/json');
  echo json_encode($response);  
?>
