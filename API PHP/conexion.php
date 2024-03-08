<?php

function conexion() {
  $conexion = mysqli_connect("localhost", "root", "", "");
  
  return $conexion;
}

?>