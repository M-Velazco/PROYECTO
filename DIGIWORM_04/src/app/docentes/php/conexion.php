<?php
function retornarConexion() {
  $con=mysqli_connect("localhost","root","","digiworm_04");// en el sena el pasword es 'sena'
  return $con;
}
?>
