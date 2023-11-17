<?php
function retornarConexion() {
  $con=mysqli_connect("127.0.0.1","root","","chat");
  return $con;
}
?>