<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
// Recibe los datos del formulario Angular
$data = json_decode(file_get_contents('php://input'), true);

// Establece la conexión a tu base de datos (ajusta los detalles según tu configuración)
require("conexion.php");
$conn = retornarConexion();

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Escapa los datos para prevenir inyección de SQL
$idusuarios = mysqli_real_escape_string($conn, $data['Idusuarios']);
$nombre_apellido = mysqli_real_escape_string($conn, $data['Nombre_apellido']);
$correo = mysqli_real_escape_string($conn, $data['Correo']);
$telefono = mysqli_real_escape_string($conn, $data['Telefono']);
$contrasena = mysqli_real_escape_string($conn, $data['Contrasena']);
$rol = mysqli_real_escape_string($conn, $data['Rol']);

// Inserta datos en la tabla 'usuarios'
$sqlUsuarios = "INSERT INTO usuarios (idusuarios, Nombre_apellido, Correo, Telefono, Contraseña, Rol) 
    VALUES ('$idusuarios', '$nombre_apellido', '$correo', '$telefono', '$contrasena', '$rol')";

$resultadoUsuarios = $conn->query($sqlUsuarios);

if (!$resultadoUsuarios) {
    $conn->close();
    echo json_encode(['success' => false, 'error' => 'Error al insertar en la tabla usuarios']);
    exit;
}

// Verifica el rol y, si es 'Docente', inserta en la tabla 'docente'
if ($rol == "Docente") {
    $sqlDocente = "INSERT INTO docente (iddocente, Nombre_apellido, Correo, Contraseña) 
        VALUES ('$idusuarios', '$nombre_apellido', '$correo', '$contrasena')";

    $resultadoDocente = $conn->query($sqlDocente);

    if (!$resultadoDocente) {
        $conn->close();
        echo json_encode(['success' => false, 'error' => 'Error al insertar en la tabla docente']);
        exit;
    }
}

// Verifica si el rol es 'Estudiante' y, si es así, inserta en la tabla 'estudiante'
if ($rol == "Estudiante") {
    $sqlEstudiante = "INSERT INTO estudiante (idestudiante, Nombre_apellido, Correo, Contraseña) 
        VALUES ('$idusuarios', '$nombre_apellido', '$correo', '$contrasena')";

    $resultadoEstudiante = $conn->query($sqlEstudiante);

    if (!$resultadoEstudiante) {
        $conn->close();
        echo json_encode(['success' => false, 'error' => 'Error al insertar en la tabla estudiante']);
        exit;
    }
}

$conn->close();
echo json_encode(['success' => true]);
