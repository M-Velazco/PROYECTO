<?php

// Establecer encabezado para indicar que el contenido es JSON
header('Content-Type: application/json');

// Incluir archivo de conexión a la base de datos
include_once '../modelo/conexion.php';

// Función para manejar errores y enviar respuestas JSON
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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/PROYECTO/DIGIWORM..04/apis/CursosApis.php') {
    // Realizar la consulta a la base de datos para obtener cursos y docentes asociados
    $consulta = $conexion->query("SELECT docente.Curso, docente.Nombres, docente.Apellidos, curso.Nombre_curso AS Nombre_curso
    FROM docente
    INNER JOIN curso ON docente.Curso = curso.idCurso");

    // Verificar si se encontraron resultados
    if ($consulta) {
        // Verificar si se encontraron cursos
        if ($consulta->num_rows > 0) {
            // Array para almacenar los datos de los cursos y sus docentes
            $cursos = array();

            // Iterar sobre los resultados y almacenarlos en el array
            while ($row = $consulta->fetch_assoc()) {
                $cursos[] = $row;
            }

            // Devolver los datos de los cursos en formato JSON
            sendResponse(200, "Éxito", $cursos);
        } else {
            sendResponse(404, "No se encontraron cursos.");
        }
    } else {
        sendResponse(500, "Error al ejecutar la consulta: " . $conexion->error);
    }
}

// Operación GET para obtener todos los cursos
elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === 'AllCourses.php') {
    // Realizar la consulta a la base de datos para obtener todos los cursos
    $consulta = $conexion->query("SELECT * FROM curso");

    // Verificar si se encontraron resultados
    if ($consulta) {
        // Verificar si se encontraron cursos
        if ($consulta->num_rows > 0) {
            // Array para almacenar los datos de los cursos
            $cursos = array();

            // Iterar sobre los resultados y almacenarlos en el array
            while ($row = $consulta->fetch_assoc()) {
                $cursos[] = $row;
            }

            // Devolver los datos de los cursos en formato JSON
            sendResponse(200, "Éxito", $cursos);
        } else {
            sendResponse(404, "No se encontraron cursos.");
        }
    } else {
        sendResponse(500, "Error al ejecutar la consulta: " . $conexion->error);
    }
}

// Operación POST para agregar un nuevo curso
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = json_decode(file_get_contents("php://input"), true);

    // Recibir los datos del nuevo curso del objeto JSON
    $nombre_curso = $postData['Nombre_curso'];
    $estado = $postData['Estado'];
    $jornada = $postData['Jornada'];

    // Consulta SQL para insertar un nuevo curso
    $postQuery = "INSERT INTO curso (Nombre_curso, Estado, Jornada) VALUES ('$nombre_curso', '$estado', '$jornada')";

    // Ejecutar la consulta
    if ($conexion->query($postQuery) === TRUE) {
        sendResponse(200, "Curso agregado exitosamente.");
    } else {
        sendResponse(500, "Error al agregar el curso: " . $conexion->error);
    }
}


// Operación PUT para actualizar un curso existente
elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $postData = json_decode(file_get_contents("php://input"), true);
    // Recibir los datos del curso a actualizar a través del cuerpo de la solicitud PUT
    $id_curso = $postData['idCurso'];
    $nombre_curso = $postData['Nombre_curso'];
    $estado = $postData['Estado'];
    $jornada = $postData['Jornada'];
    // Consulta SQL para actualizar un curso existente
    $putQuery = "UPDATE curso SET Nombre_curso='$nombre_curso', Estado='$estado', Jornada='$jornada' WHERE idCurso='$id_curso'";

    // Ejecutar la consulta
    if ($conexion->query($putQuery) === TRUE) {
        sendResponse(200, "Curso actualizado exitosamente.");
    } else {
        sendResponse(500, "Error al actualizar el curso: " . $conexion->error);
    }
}
elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Recibir los datos del curso a eliminar a través de la URI
    $id_curso = $_GET['idCurso'];

    // Consulta SQL para eliminar un curso existente
    $deleteQuery = "DELETE FROM curso WHERE idCurso='$id_curso'";

    // Ejecutar la consulta
    if ($conexion->query($deleteQuery) === TRUE) {
        sendResponse(200, "Curso eliminado exitosamente.");
    } else {
        sendResponse(500, "Error al eliminar el curso: " . $conexion->error);
    }
}


// Si no se especifica un método válido
else {
    sendResponse(405, "Método no permitido.");
}

// Cerrar la conexión con la base de datos
$conexion->close();

?>
