<?php
function Conectarse()
{
    $localhost = "localhost";
    $usuario = "root";
    $contraseña = ""; // Reemplaza 'tu_contraseña' con la contraseña correcta
    $bd = "digiworm";
//	$port=3306;

    $conexion = new mysqli($localhost, $usuario, $contraseña, $bd);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    return $conexion;
}
?>
