<?php
function retornarConexion() {
  $conn=mysqli_connect("localhost","root","","digiworm");// en el sena el pasword es 'sena'
  return $conn;
}
?>