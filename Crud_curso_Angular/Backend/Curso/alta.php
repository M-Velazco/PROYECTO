<?php
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("conexion.php");
$con = retornarConexion();

// Obtener el método de la solicitud (POST, GET, etc.)
$method = $_SERVER['REQUEST_METHOD'];

// Manejar la solicitud según el método
switch ($method) {
    case 'POST':
        // Si la solicitud es un POST, realizar la inserción en la base de datos
        insertarCurso($con, $params);
        break;

    // Otros casos según sea necesario (GET, PUT, DELETE, etc.)

    default:
        // Manejar otros métodos si es necesario
        break;
}

// Función para insertar un nuevo curso en la base de datos
function insertarCurso($conexion, $datosCurso) {
    $idCurso = $datosCurso->idcurso;
    $nomCurso = $datosCurso->nom_curso;
    $estado = $datosCurso->estado;

    // Realizar la inserción en la base de datos
    mysqli_query($conexion, "INSERT INTO curso (idcurso, nom_curso, estado) VALUES ($idCurso, '$nomCurso', '$estado')");

    // Crear la respuesta
    $response = new stdClass();
    $response->resultado = 'OK';
    $response->mensaje = 'Datos grabados';

    // Enviar la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
