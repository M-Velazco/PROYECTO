<?php
function retornarConexion() {
  $con=mysqli_connect("localhost","root","","digiworm_04");
  return $con;
}
?>
