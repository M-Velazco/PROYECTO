<?php
function retornarConexion() {
  $con = mysqli_connect("localhost", "root", "", "digiworm");
  if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
  }
  return $con;
}
?>
