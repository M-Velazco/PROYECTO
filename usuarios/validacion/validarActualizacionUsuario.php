<?php
require("../modelo/USUARIO.php");
require("../modelo/conexion.php");
extract($_REQUEST);

// Verificar si se ha enviado el formulario
extract ($_REQUEST);
$objConexion=Conectarse();
$contraseña = $_REQUEST['NuevaContrasena'];
$contraseñamd5 = md5($contraseña);
$sql="update `usuarios` set idusuario ='$_REQUEST[Idusuario]', Nombre_apellido = '$_REQUEST[Nombre]', Correo = '$_REQUEST[Correo]', Telefono = '$_REQUEST[Telefono]', Contraseña = $contraseñamd5, Rol = '$_REQUEST[Rol]' where idusuario = '$_REQUEST[Idusuario]'";

$resultado=$objConexion->query($sql);

if ($resultado == TRUE)
	header("location: listardocente.php?x=1");  //x=1 quiere decir que se modifico bien
else
	echo "no se pudo actualizar";  //x=2 quiere decir que no se pudo modificar

?>
