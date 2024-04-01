<?php

include_once '../modelo/conexion.php';
include_once '../modelo/USUARIO.php';

// Crear conexión con la base de datos
$Conexion = Conectarse(); // Suponiendo que la función Conectarse() está definida en el archivo '../modelo/conexion.php'

// Verificar la conexión
if ($Conexion->connect_error) {
    die("Conexión fallida: " . $Conexion->connect_error);
}

// Realizar la consulta a la base de datos
$consulta = $Conexion->query("SELECT usuarios.Nombres, usuarios.Apellidos, usuarios.img, docente.Materia, materias.Nombre_Materia AS nombre_materia
FROM usuarios 
INNER JOIN docente ON usuarios.Idusuarios = docente.idDocente
INNER JOIN materias ON docente.Materia = materias.idMaterias");

// Verificar si se encontraron resultados
if ($consulta->num_rows > 0) {
    // Array para almacenar los datos de los docentes y sus materias
    $docentes = array();

    // Iterar sobre los resultados y almacenarlos en el array
    while ($row = $consulta->fetch_assoc()) {
        $docentes[] = $row;
    }

    // Devolver los datos de los docentes y sus materias en formato JSON
    echo json_encode($docentes);
} else {
    echo "No se encontraron docentes con materias asignadas.";
}

// Cerrar la conexión con la base de datos
$Conexion->close();

?>
