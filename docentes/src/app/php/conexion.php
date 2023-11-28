<?php
function retornarConexion() {
  $con=mysqli_connect("localhost","root","sena","digiworm");// en el sena el pasword es 'sena'
  return $con;
}
?>
