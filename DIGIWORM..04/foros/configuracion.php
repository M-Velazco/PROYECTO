<?php
$bd_host = "localhost";
$bd_usuario = "root";
$bd_password = "sena";
$bd_base = "digiworm_04";

$con = mysqli_connect($bd_host, $bd_usuario, $bd_password, $bd_base);

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "Error al conectar a MySQL: " . mysqli_connect_error();
    exit();
}
?>