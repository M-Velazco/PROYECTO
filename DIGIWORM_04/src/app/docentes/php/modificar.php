<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("conexion.php");
$con = retornarConexion();

// Escapar y validar los datos
$idDocente = mysqli_real_escape_string($con, $params->idDocente);
$Nombres = mysqli_real_escape_string($con, $params->Nombres);
$Apellidos = mysqli_real_escape_string($con, $params->Apellidos);
$Email = mysqli_real_escape_string($con, $params->Email);
$Contrasena = mysqli_real_escape_string($con, $params->Contrasena); // Contraseña sin hash

// Aplicar hash a la contraseña
$hashedContrasena = password_hash($Contrasena, PASSWORD_DEFAULT);

$Curso = mysqli_real_escape_string($con, $params->Curso);
$Materia = mysqli_real_escape_string($con, $params->Materia);

$query = "UPDATE docente SET `idDocente`='$idDocente',`Nombres`='$Nombres',`Apellidos`='$Apellidos',`Email`='$Email',`Pasword`='$Contrasena',`Curso`='$Curso',`Materia`='$Materia' WHERE `idDocente`='$idDocente' ";

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
