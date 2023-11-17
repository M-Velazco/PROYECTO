<?php
require "../CtrlDocentes/modeloDocentes/conexion.php";
extract ($_REQUEST);

$objConexion = Conectarse();

$sql="delete from docente where iddocente = '$_REQUEST[IDdocente]'";

$resultado = $objConexion->query($sql);

if ($resultado)
	header("location: listarDocente.php?x=3");  //x=3 quiere decir que se eliminó bien
else
	header("location: listarDocente.php?x=4");  //x=4 quiere decir que no se pudo eliminar
?>
