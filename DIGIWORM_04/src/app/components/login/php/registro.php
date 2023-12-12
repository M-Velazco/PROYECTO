<?php
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  require("conexion.php");
  $con = retornarConexion();

  
  $idusuarios = $_POST['Idusuarios'];
  $contrasena = $_POST['Contrasena'];
  $nombre_apellido = $_POST['Nombre_apellido'];
  $correo = $_POST['Correo'];
  $telefono = $_POST['Telefono'];
  $rol = $_POST['Rol'];

  
  $idusuarios = mysqli_real_escape_string($con, $Idusuarios);
  $contrasena = mysqli_real_escape_string($con, $contrasena);
  $nombre_apellido = mysqli_real_escape_string($con, $nombre_apellido);
  $correo = mysqli_real_escape_string($con, $correo);
  $telefono = mysqli_real_escape_string($con, $telefono);
  $rol = mysqli_real_escape_string($con, $rol);

  
  $insert_query = "INSERT INTO usuarios (Idusuarios, Contrasena, Nombre_apellido, Correo, Telefono, Rol) 
                   VALUES ('$Idusuarios', '$contrasena', '$nombre_apellido', '$correo', '$telefono', '$rol')";

  if (mysqli_query($con, $insert_query)) {
    
    $response = array('status' => 'success', 'message' => 'Datos insertados con éxito');
  } else {
    
    $response = array('status' => 'error', 'message' => 'Error al insertar datos: ' . mysqli_error($con));
  }

  header('Content-Type: application/json');
  echo json_encode($response);
?>