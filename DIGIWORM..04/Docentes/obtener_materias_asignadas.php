<?php
// Aquí deberías tener tu conexión a la base de datos ya establecida
require_once "../modelo/conexion.php";

$conn = Conectarse();

if(isset($_GET['id'])) {
    $idDocente = $_GET['id'];

    // Consulta para obtener las materias asignadas al docente
    $sql = "SELECT materias.Nombre_Materia
            FROM materias
            INNER JOIN docente_materia
            ON materias.idMaterias = docente_materia.idMateria
            WHERE docente_materia.idDocente = $idDocente";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si hay resultados, formamos una lista de materias
        $materias = "<ul>";
        while ($row = $result->fetch_assoc()) {
            $materias .= "<li>" . $row['Nombre_Materia'] . "</li>";
        }
        $materias .= "</ul>";
        echo $materias;
    } else {
        // Si no hay resultados, mostramos un mensaje indicando que no hay materias asignadas
        echo "<p>No hay materias asignadas para este docente.</p>";
    }
} else {
    // Si no se proporciona un ID de docente, mostramos un mensaje de error
    echo "<p>Selecciona un docente primero.</p>";
}
?>
