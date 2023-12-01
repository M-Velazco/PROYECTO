<?php
//Se reciben los datos del formulario
require ( "../modelo\USUARIO.php");
require "../modelo/conexion.php";
extract ($_REQUEST);

//Forma utilizando la Clase Empleado
$contrasena = $_REQUEST['Contrasena'];
$contrasenamd5 = md5($contrasena);
$objUsuario = new Usuario();

$objUsuario->crearUsuario($_REQUEST['Idusuario'] , $_REQUEST['Nombre'], $_REQUEST['Correo'], $_REQUEST['Telefono'] ,$contrasenamd5 , $_REQUEST['Rol']);

$resultado = $objUsuario->agregarUsuario();

if ($resultado == TRUE)
header("Location: " . $_SERVER['HTTP_REFERER']);  //x=5 quiere decir que se agrego bien
else
	echo "no se ha registrado bien"; //x=6 quiere decir que no se pudo agregar

?>