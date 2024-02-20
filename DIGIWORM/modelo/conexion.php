<?php
function Conectarse()
{
	$Conexion=new mysqli("localhost","root","","digiworm_04");
	
	if ($Conexion->connect_errno) 
		echo "Problemas en la Conexion ". $Conexion->connect_error;
	else
		return $Conexion;
}

?>