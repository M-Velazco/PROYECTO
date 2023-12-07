<?php
function retornarConexion() {
  $con=mysqli_connect("localhost","root","","digiworm");
  return $con;
}
?>