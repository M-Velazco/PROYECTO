<?php

include_once '../modelo/conexion.php';

// Crear conexión con la base de datos
$Conexion = Conectarse(); // Suponiendo que la función Conectarse() está definida en el archivo '../modelo/conexion.php'

// Verificar la conexión
if ($Conexion->connect_error) {
    die("Conexión fallida: " . $Conexion->connect_error);
}

// Realizar la consulta a la base de datos
$consulta = $Conexion->query("SELECT docente.Curso, docente.Nombres, docente.Apellidos  , curso.Nombre_curso AS Nombre_curso
FROM docente 
INNER JOIN curso ON docente.Curso = curso.idCurso

"); //realizar prueba sql y corregir


// Verificar si se encontraron resultados
if ($consulta->num_rows > 0) {
    // Array para almacenar las opiniones
    $Cursos = array();

    // Iterar sobre los resultados y almacenarlos en el array
    while ($row = $consulta->fetch_assoc()) {
        $Cursos[] = $row;
    }

    // Devolver las opiniones en formato JSON
    echo json_encode($Cursos);
} else {
    echo "No se encontraron Cursos.";
}

// Cerrar la conexión con la base de datos
$Conexion->close();

?>
