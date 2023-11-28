<?php
function retornarConexion() {
  $con=mysqli_connect("localhost","root","sena","digiworm");
  return $con;
}
?>