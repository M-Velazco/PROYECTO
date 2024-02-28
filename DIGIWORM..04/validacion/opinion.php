<?php 
require_once "../modelo/conexion.php";

// Obtener los valores del formulario POST
$Conexion=new mysqli("localhost","root","sena","digiworm_04");
$Nombres_apellidos = $_POST['Nombres_Apellidos'];
$Email = $_POST['Email'];
$Opinion = $_POST['Opinion'];

// Consulta SQL para insertar datos en la tabla
$sql = "INSERT INTO opiniones (Nombres_Apellidos, Email, Opinion) VALUES ('$Nombres_apellidos', '$Email', '$Opinion')";

// Ejecutar la consulta
if ($Conexion->query($sql) === TRUE) {
    echo "Registro insertado correctamente";
} else {
    echo "Error al insertar registro: " . $Conexion->error;
}

// Cerrar la conexión
$Conexion->close();
?>
