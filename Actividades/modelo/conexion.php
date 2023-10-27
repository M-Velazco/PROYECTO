
<!-- Eesta es la conexion a la bd -->

<?php
function Conectarse()
{
	$Conexion=new mysqli("localhost","root","","digiworm");
	
	if ($Conexion->connect_errno) 
		echo "Problemas en la Conexion ". $Conexion->connect_error;
	else
		return $Conexion;
}

?>