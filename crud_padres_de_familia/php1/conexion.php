<?php
function retornarConexion() {
  $con=mysqli_connect("localhost","root","","digiworn1");
  return $con;
}
?>