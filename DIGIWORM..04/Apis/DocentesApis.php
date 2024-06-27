<?php

// Establecer encabezado para indicar que el contenido es JSON
header('Content-Type: application/json');

// Incluir archivos necesarios
include_once '../modelo/conexion.php';
include_once '../modelo/USUARIO.php';

// Función para manejar errores
function sendResponse($status, $message, $data = null) {
    http_response_code($status);
    echo json_encode(array('status' => $status, 'message' => $message, 'data' => $data));
    exit();
}

// Crear conexión con la base de datos
$conexion = Conectarse(); // Suponiendo que la función Conectarse() está definida en el archivo '../modelo/conexion.php'

// Verificar la conexión
if ($conexion->connect_error) {
    sendResponse(500, "Conexión fallida: " . $conexion->connect_error);
}

// Manejar la solicitud según el método HTTP
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Realizar la consulta a la base de datos para obtener docentes con materias asignadas
        $consulta = $conexion->query("SELECT usuarios.Nombres, usuarios.Apellidos, usuarios.img, docente.Materia, materias.Nombre_Materia AS nombre_materia
        FROM usuarios
        INNER JOIN docente ON usuarios.Idusuarios = docente.idDocente
        INNER JOIN materias ON docente.Materia = materias.idMaterias");

        // Verificar si se encontraron resultados
        if ($consulta) {
            // Verificar si se encontraron docentes con materias asignadas
            if ($consulta->num_rows > 0) {
                // Array para almacenar los datos de los docentes y sus materias
                $docentes = array();

                // Iterar sobre los resultados y almacenarlos en el array
                while ($row = $consulta->fetch_assoc()) {
                    $docentes[] = $row;
                }

                // Devolver los datos de los docentes y sus materias en formato JSON
                sendResponse(200, "Éxito", $docentes);
            } else {
                sendResponse(404, "No se encontraron docentes con materias asignadas.");
            }
        } else {
            sendResponse(500, "Error al ejecutar la consulta.");
        }
        break;

        case 'POST':
            // Manejar la solicitud POST para agregar un nuevo docente con materia asignada
            $postData = json_decode(file_get_contents("php://input"), true);

            // Recibir y procesar los datos del nuevo docente del objeto JSON
            $idDocente = $postData['idDocente'];
            $nombres = $postData['Nombres'];
            $apellidos = $postData['Apellidos'];
            $email = $postData['Email'];
            $password = $postData['Pasword'];
            $curso = $postData['Curso'];
            $materia = $postData['Materia'];
            $jornada = $postData['Jornada'];
            $certificacion = $postData['Certificacion'];
            $desc_prof = $postData['Desc_prof'];

            // Consulta SQL para insertar un nuevo docente
            $postQuery = "INSERT INTO docente (idDocente,Nombres, Apellidos, Email, Pasword, Curso, Materia, Jornada, Certificacion, Desc_prof) VALUES ('$idDocente','$nombres', '$apellidos', '$email', '$password', '$curso', '$materia', '$jornada', '$certificacion', '$desc_prof')";

            // Ejecutar la consulta
            if ($conexion->query($postQuery) === TRUE) {
                sendResponse(200, "Docente agregado exitosamente.");
            } else {
                sendResponse(500, "Error al agregar el docente: " . $conexion->error);
            }
            break;


            case 'PUT':
                // Manejar la solicitud PUT para actualizar un docente existente
                $putData = json_decode(file_get_contents("php://input"), true);

                // Recibir y procesar los datos del docente a actualizar del objeto JSON
                $idDocente = $putData['idDocente'];
                $nombres = $putData['Nombres'];
                $apellidos = $putData['Apellidos'];
                $email = $putData['Email'];
                $password = $putData['Pasword'];
                $curso = $putData['Curso'];
                $materia = $putData['Materia'];
                $jornada = $putData['Jornada'];
                $certificacion = $putData['Certificacion'];
                $desc_prof = $putData['Desc_prof'];

                // Consulta SQL para actualizar el docente
                $putQuery = "UPDATE docente SET Nombres='$nombres', Apellidos='$apellidos', Email='$email', Pasword='$password', Curso='$curso', Materia='$materia', Jornada='$jornada', Certificacion='$certificacion', Desc_prof='$desc_prof' WHERE idDocente='$idDocente'";

                // Ejecutar la consulta
                if ($conexion->query($putQuery) === TRUE) {
                    sendResponse(200, "Docente actualizado exitosamente.");
                } else {
                    sendResponse(500, "Error al actualizar el docente: " . $conexion->error);
                }
                break;
                case 'DELETE':
                    // Manejar la solicitud DELETE para eliminar un docente y su materia asignada
                    $idDocente = $_GET['idDocente'];

                    // Consulta SQL para eliminar el docente
                    $deleteQuery = "DELETE FROM docente WHERE idDocente='$idDocente'";

                    // Ejecutar la consulta
                    if ($conexion->query($deleteQuery) === TRUE) {
                        sendResponse(200, "Docente eliminado exitosamente.");
                    } else {
                        sendResponse(500, "Error al eliminar el docente: " . $conexion->error);
                    }
                    break;

                default:
                    sendResponse(405, "Método no permitido.");
            }

// Cerrar la conexión con la base de datos
$conexion->close();

?>
