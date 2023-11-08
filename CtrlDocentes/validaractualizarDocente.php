<?php
require ( "../ctrlDocentes/modeloDocentes/Docentes.php");
require "../ctrlDocentes/modeloDocentes/conexion.php";

extract ($_REQUEST);
$objConexion=Conectarse();
$Contraseña = $_POST['Contraseña'];
$Contraseñamd5 = md5($Contraseña);

$sql="update docente set iddocente ='$_REQUEST[IDdocente]', Nombre_apellido = '$_REQUEST[fNombre_apellidos]', Correo = '$_REQUEST[fCorreo]', Contraseña = $Contraseñamd5, Curso_pr = '$_REQUEST[fCurso_pr]', Materia = '$_REQUEST[fMateria]' where iddocente = '$_REQUEST[IDdocente]'";

$resultado=$objConexion->query($sql);

if ($resultado)
	header("location: listardocente.php?x=1");  //x=1 quiere decir que se modifico bien
else
	echo "no se pudo actualizar";  //x=2 quiere decir que no se pudo modificar

?>


