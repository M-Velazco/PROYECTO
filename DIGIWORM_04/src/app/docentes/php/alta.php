<?php 
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("conexion.php");
$con = retornarConexion();

// Escapar y validar los datos
$iddocente = mysqli_real_escape_string($con, $params->iddocente);
$Nombre_apellido = mysqli_real_escape_string($con, $params->Nombre_apellido);
$Correo = mysqli_real_escape_string($con, $params->Correo);
$Contrasena = mysqli_real_escape_string($con, $params->Contrasena); // Contraseña sin hash

// Aplicar hash a la contraseña
$hashedContrasena = password_hash($Contrasena, PASSWORD_DEFAULT);

$Curso_pr = mysqli_real_escape_string($con, $params->Curso_pr);
$Materia = mysqli_real_escape_string($con, $params->Materia);

$query = "INSERT INTO docente (iddocente, Nombre_apellido, Correo, Contrasena, Curso_pr, Materia) VALUES ($iddocente, '$Nombre_apellido', '$Correo', '$hashedContrasena', '$Curso_pr', '$Materia')";

// Ejecutar la consulta
$resultado = mysqli_query($con, $query);

class Result {}

$response = new Result();

if ($resultado) {
    $response->resultado = 'OK';
    $response->mensaje = 'datos grabados';
} else {
    $response->resultado = 'Error';
    $response->mensaje = 'Error al grabar datos: ' . mysqli_error($con);
}

header('Content-Type: application/json');
echo json_encode($response);
?>
