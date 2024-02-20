<?php
//Se reciben los datos del formulario
require ( "../modelo\USUARIO.php");
require "../modelo/conexion.php";
extract ($_REQUEST);

//Forma utilizando la Clase Empleado
$contrasena = $_REQUEST['Contrasena'];
$paswordmd5 = md5($contrasena);
$objUsuario = new Usuario();

$objUsuario->crearUsuario($_REQUEST['Idusuario'] , $_REQUEST['Nombres'], $_REQUEST['Apellidos'], $_REQUEST['Email'], $_REQUEST['Telefono'] ,$paswordmd5 , $_REQUEST['img'], $_REQUEST['Rol'], $_REQUEST['Estado']);

$resultado = $objUsuario->agregarUsuario();

if ($resultado == TRUE)
header("Location: " . $_SERVER['HTTP_REFERER']);  //x=5 quiere decir que se agrego bien
else
	echo "no se ha registrado bien"; //x=6 quiere decir que no se pudo agregar

?>